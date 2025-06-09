<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
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
        return response()->json([
            'users' => $users,
            'packages' => $packages,
        ]);
    }
    public function store(Request $request)
    {
        $messages = [
            'email.unique' => 'Email đã tồn tại, chọn email khác nhé.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
        ], $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $package = User::create([
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
        return response()->json($package, 201);
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
        $users->address = $request->address;
        $users->expiration_package = $request->expiration_package;
        $users->note = $request->note;
        $users->status = $request->status;
        $users->save();
        return response()->json(['message' => 'Cập nhật thành công']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user, 200);
    }
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return response()->json('Xoá thành công');
    }
}
