<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('Frontend/Normal/Pages/dashboard');
    }
    public function roles_page()
    {
        return view('Frontend/Normal/Admin_Pages/Roles/roles');
    }

    public function our_plans()
    {

        return view('Frontend/Normal/CommonPages/subscription_plans');
    }

    public function search_users(Request $request)
    {
        $search = $request->get('query');

        $users = User::where('name', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get();

        return response()->json($users);
    }


    public function getRoles(Request $request)
    {
        $validatedData = $request->validate([
            "user_name" => "required|exists:users,name",
        ]);

        $user = User::with('roles')->where('name', $validatedData['user_name'])->first();

        $roles = Role::all();


        $hasRoles = $user->roles->pluck('name');

        return response()->json([
            "status" => true,
            "role" => $user,
            "roles" => $roles,
            "hasRoles" => $hasRoles
        ], 200);
    }
}
