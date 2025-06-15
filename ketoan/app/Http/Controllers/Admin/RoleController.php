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
            'status' => $data['status'],
            'default_role' => $data['default_role'] ?? 0,
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
            'permissions.*' => 'exists:permissions,id',
            'default_role' => 'nullable|in:0,1'
        ]);
        if ($request->input('default_role') == 1) {
            Role::where('default_role', 1)->update(['default_role' => 0]);
        }
        $role->update([
            'name'   => $data['name'],
            'note'   => $data['note'] ?? null,
            'status' => $data['status'],
            'default_role' => $request->input('default_role', 0),
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
    $permissions = Permission::all();

    // Gom nhóm theo module
    $modules = [];
    foreach ($permissions as $permission) {
    $parts = explode('.', $permission->name);

    // Nếu không đủ module.action thì bỏ qua hoặc xử lý khác
    if (count($parts) < 2) {
        continue;  // hoặc bạn có thể log ra lỗi để kiểm tra
    }

    [$moduleKey, $actionKey] = $parts;

    if (!isset($modules[$moduleKey])) {
        $modules[$moduleKey] = [
            'module'  => $moduleKey,
            'actions' => []
        ];
    }

    $modules[$moduleKey]['actions'][] = [
        'id'   => $permission->id,
        'name' => $permission->display_name ?? $actionKey,
        'key'  => $actionKey
    ];
}


    // Reset index
    $modules = array_values($modules);

    return response()->json($modules);
}

}
