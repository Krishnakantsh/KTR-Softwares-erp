<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{


    public function assignRoleToModel()
    {
        return view('Frontend/Normal/Admin_Pages/Roles/assign_role');
    }


    public function assignRole(Request $request)
    {
        try {

            $validated = $request->validate([
                'user_name' => "required|string",
                "roles" => "nullable|array",
                "roles.*" => "exists:roles,name"
            ]);

            $user = User::where('name', $validated['user_name'])->first();

            if (!$user) {
                return response()->json([
                    "status" => false,
                    "message" => "User not found",
                ], 404);
            }

            $user->syncRoles($validated['roles'] ?? []);

            return response()->json([
                "status" => true,
                "message" => "Role assign succesfuly !!! ",
                "data" => [
                    "id" => $user->id,
                    "name" => $user->name,
                    "roles" => $user->getRoleNames()
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage(),
            ], 500);
        }
    }


    public function add_role(Request $request)
    {
        $data = $request->validate([
            'role_name' => "required|string|max:255",
            "role_id" => "nullable|exists:roles,id"
        ]);

        $res = Role::updateOrCreate([
            'id' => $data['role_id']
        ], [
            'name' => $data['role_name'],
            'gaurd_name' => "web"
        ]);

        if (!$res) {
            return response()->json([
                "success" => false,
                "message" => "Failed to create role"
            ], 500);
        }

        return response()->json([
            "success" => true,
            "message" => "Role is created successfully",
            "created_role" => $res
        ], 201);
    }

    public function getRoleWithPermissions(Request $request)
    {
        $validatedData = $request->validate([
            "role_name" => "required|exists:roles,name",
        ]);

        // find role with name 

        $role = Role::with('permissions')->where('name', $validatedData['role_name'])->first();

        //  fetch all available permissons

        $permissions = Permission::all();


        $hasPermissions = $role->permissions->pluck('name');

        return response()->json([
            "status" => true,
            "role" => $role,
            "permissions" => $permissions,
            "hasPermissions" => $hasPermissions
        ], 200);
    }

    public function get_roles()
    {
        $roles = Role::all();

        if (empty($roles)) {
            return response()->json([
                "success" => false,
                "message" => "Roles data is empty"
            ], 500);
        }

        return response()->json([
            "success" => true,
            "data" => $roles
        ], 200);
    }

    public function delete_role(Request $request)
    {
        $data = $request->validate([
            "id" => "required|exists:roles,id"
        ]);

        $res = Role::findOrFail($data['id']);

        if (!$res) {
            return response()->json([
                "success" => false,
                "message" => "Role data not found"
            ], 500);
        }

        $res->delete();

        return response()->json([
            "success" => true,
            "message" => "Role is deleted successfully",
            "deleted_role" => $res
        ], 201);
    }


    public function getRoleById(Request $request)
    {
        $data = $request->validate([
            "role_id" => "required|exists:roles,id"
        ]);

        $res = Role::findOrFail($data['role_id']);

        if (!$res) {
            return response()->json([
                "success" => false,
                "message" => "Role data not found"
            ], 500);
        }

        return response()->json([
            "success" => true,
            "data" => $res
        ], 200);
    }


    public function searchRoles(Request $request)
    {
        $search = $request->get('query');

        $roles = Role::where('name', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get();

        return response()->json($roles);
    }
}
