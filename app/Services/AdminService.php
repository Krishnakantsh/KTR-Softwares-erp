<?php

namespace App\Services;

use App\Models\AllSchool;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class AdminService
{

    public function createSchoolClient($data)
    {
        return AllSchool::updateOrCreate(
            [
                'username' => $data['username'],
            ],
            [
                'name' => $data['name'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),

                'db_name' => $data['db_name'],
                'db_pass' => $data['db_pass'] ?? null,
                'db_user' => $data['db_user'] ?? null,

                'plan_id' => $data['plan_id'],
                'school_id' => $data['school_id'],

                'start_date' => $data['start_date'] ?? now(),
                'valid_upto' => $data['valid_upto'] ?? null,
                'grace_period' => $data['grace_period'] ?? 0,

                'is_active' => true,

                'email' => $data['email'] ?? null,
                'phone' => $data['phone'] ?? null,
            ]
        );
    }

    //  create auth user

    public function createAuthUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        event(new Registered($user));

        return $user;
    }
}
