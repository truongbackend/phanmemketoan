<?php

namespace App\Http\Controllers\Admin;

use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }
        $perPage = $request->input('per_page', 10);
        $users = $query->paginate($perPage);
        $packages = Package::where('status', 1)->get();
        $role = Role::where('status', 1)->get();
        return response()->json([
            'users' => $users,
            'packages' => $packages,
            'role' => $role,
        ]);
    }
    public function store(Request $request)
    {
        $messages = [
            'email.unique' => 'Email đã tồn tại, chọn email khác nhé.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'role_id' => 'required|exists:roles,id',
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'expiration_package' => $request->input('expiration_package'),
            'create_package' => now(),
            'note' => $request->input('note'),
            'status' => $request->input('status'),
            'password' => Hash::make('pnl@12345'),
        ]);

        $user->syncRoles([$request->input('role_id')]);

        return response()->json($user, 201);
    }
    public function update(Request $request, $id)
    {
        $messages = [
            'email.unique' => 'Email đã tồn tại, chọn email khác nhé.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email,' . $id,
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->phone = $request->phone;
        $users->packages_id = $request->packages_id;
        $users->address = $request->address;
        $users->expiration_package = $request->expiration_package;
        $users->note = $request->note;
        $users->status = $request->status;
        $users->save();
        if ($request->filled('role_id')) {
            $role = Role::find($request->input('role_id'));
            if ($role) {
                $users->syncRoles([$role->name]);
            }
        }
        return response()->json(['message' => 'Cập nhật thành công']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role = $user->roles()->first();
        $user->role_id = $role ? $role->id : null;
        return response()->json($user, 200);
    }
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return response()->json('Xoá thành công');
    }
}
