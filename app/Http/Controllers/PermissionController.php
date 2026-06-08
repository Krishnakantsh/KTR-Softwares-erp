<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        return view('Frontend/Normal/Admin_Pages/Permissions/permissions');
    }


    public function assign_permission_view()
    {
        return view('Frontend/Normal/Admin_Pages/Permissions/assign_permission');
    }

    public function assign_permission(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role_name' => 'required|exists:roles,name',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $role = Role::where('name', $request->role_name)->first();

            $role->syncPermissions($request->permissions);

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Role permissions synced successfully"
            ], 200);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "error" => $e->getMessage()
            ], 500);
        }
    }


    public function add_permission(Request $request)
    {
        $data = $request->validate([
            'permission_name' => "required|string|max:255",
            "permission_id" => "nullable|exists:permissions,id"
        ]);

        $res = Permission::updateOrCreate([
            'id' => $data['permission_id']
        ], [
            'name' => $data['permission_name'],
            'gaurd_name' => "web"
        ]);

        if (!$res) {
            return response()->json([
                "success" => false,
                "message" => "Failed to create permission"
            ], 500);
        }

        return response()->json([
            "success" => true,
            "message" => "Permission is created successfully",
            "created_permission" => $res
        ], 201);
    }


    public function get_permissions()
    {
        $permissions = Permission::all();

        if (empty($permissions)) {
            return response()->json([
                "success" => false,
                "message" => "Permissions data is empty"
            ], 500);
        }

        return response()->json([
            "success" => true,
            "data" => $permissions
        ], 200);
    }

    public function delete_permission(Request $request)
    {
        $data = $request->validate([
            "id" => "required|exists:permissions,id"
        ]);

        $res = Permission::findOrFail($data['id']);

        if (!$res) {
            return response()->json([
                "success" => false,
                "message" => "Permission data not found"
            ], 500);
        }

        $res->delete();

        return response()->json([
            "success" => true,
            "message" => "Permission is deleted successfully",
            "deleted_permission" => $res
        ], 201);
    }


    public function get_permission_by_id(Request $request)
    {
        $data = $request->validate([
            "permission_id" => "required|exists:permissions,id"
        ]);

        $res = Permission::findOrFail($data['permission_id']);

        if (!$res) {
            return response()->json([
                "success" => false,
                "message" => "Permission data not found"
            ], 500);
        }

        return response()->json([
            "success" => true,
            "data" => $res
        ], 200);
    }
}
