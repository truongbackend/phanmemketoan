<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleController extends Controller
{
   public function index()
    {
        return Role::with('permissions')->get();
    }

    // 2. Tạo mới role + gán permissions
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|unique:roles,name',
            'note'        => 'nullable|string',
            'status'      => 'required|in:0,1',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role = Role::create([
            'name'   => $data['name'],
            'note'   => $data['note'] ?? null,
            'status' => $data['status']
        ]);

        if (!empty($data['permissions'])) {
            $role->syncPermissions($data['permissions']);
        }

        return response()->json([
            'message' => 'Tạo role thành công',
            'role'    => $role->load('permissions')
        ], 201);
    }

    // 3. Cập nhật role + gán lại permissions
    public function update(Request $request, $id)
    {
        $role = Role::findById($id);

        $data = $request->validate([
            'name'        => 'required|unique:roles,name,'.$role->id,
            'note'        => 'nullable|string',
            'status'      => 'required|in:0,1',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id'
        ]);

        $role->update([
            'name'   => $data['name'],
            'note'   => $data['note'] ?? null,
            'status' => $data['status']
        ]);

        $role->syncPermissions($data['permissions'] ?? []);

        return response()->json([
            'message' => 'Cập nhật role thành công',
            'role'    => $role->load('permissions')
        ]);
    }

    // 4. Xóa role
    public function destroy($id)
    {
        $role = Role::findById($id);
        $role->delete();
        return response()->json(['message' => 'Xóa role thành công']);
    }

    // 5. Danh sách permission để chọn
    public function permissions()
    {
        return Permission::all();
    }
}
