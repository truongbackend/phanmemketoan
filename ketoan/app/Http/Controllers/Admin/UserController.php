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
        'name.required' => 'Vui lòng nhập họ và tên.',
        'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',
        'email.required' => 'Vui lòng nhập email.',
        'email.email' => 'Định dạng email không hợp lệ.',
        'email.unique' => 'Email đã tồn tại, vui lòng chọn email khác.',
        'phone.regex' => 'Số điện thoại không hợp lệ, chỉ bao gồm 9-11 chữ số.',
        'phone.required' => 'Vui lòng nhập số điện thoại',
        'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        'address.required' => 'Vui lòng nhập địa chỉ',
        'expiration_package.required' => 'Vui lòng chọn ngày hết hạn.',
        'expiration_package.date' => 'Ngày hết hạn không hợp lệ.',
        'role_id.required' => 'Vui lòng chọn nhóm quyền.',
        'role_id.exists' => 'Nhóm quyền không tồn tại.',
        'companyName.max' => 'Tên công ty không được vượt quá 255 ký tự.',
        'companyName.required' => 'Vui lòng nhập tên công ty.',
        'companyTax.required' => 'Vui lòng nhập mã số thuê.',
    ];

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|nullable|regex:/^\d{9,11}$/',
        'address' => 'required|nullable|string|max:255',
        'expiration_package' => 'required|date',
        'role_id' => 'required|exists:roles,id',
        'companyName' => 'required|nullable|string|max:255',
        'companyTax' => 'required|nullable',
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
        'packages_id' => $request->input('packages_id'),
        'companyName' => $request->input('companyName'),
        'companyTax' => $request->input('companyTax'),
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

        $user = User::findOrFail($id);
        $updated = false;

        // Kiểm tra và update password nếu có yêu cầu đổi
        if ($request->filled('old_password') && $request->filled('new_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json(['error' => 'Mật khẩu cũ không đúng'], 400);
            }
            $user->password = Hash::make($request->new_password);
            $updated = true;
        }

        // Danh sách các field cần kiểm tra
        $fields = [
            'name', 'email', 'phone', 'packages_id',
            'address', 'expiration_package', 'note', 'status','companyName','companyTax'
        ];

        foreach ($fields as $field) {
            if ($request->has($field) && $request->$field != $user->$field) {
                $user->$field = $request->$field;
                $updated = true;
            }
        }

        if ($updated) {
            $user->save();
        }

        // Update role nếu có yêu cầu và khác role hiện tại
        if ($request->filled('role_id')) {
            $role = Role::find($request->input('role_id'));
            if ($role && !$user->hasRole($role->name)) {
                $user->syncRoles([$role->name]);
            }
        }

        return response()->json([
            'message' => $updated ? 'Cập nhật thành công' : 'Không có thay đổi nào'
        ]);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $role = $user->roles()->first();
        $user->role_id = $role ? $role->id : null;
        $user->packages_id = $user->packages_id;
        return response()->json($user, 200);
    }
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return response()->json('Xoá thành công');
    }
}
