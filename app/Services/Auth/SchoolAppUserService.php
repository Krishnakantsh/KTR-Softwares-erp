<?php

namespace App\Services\Auth;

use App\Models\SchoolAppUser;
use Illuminate\Support\Facades\Hash;

class SchoolAppUserService
{
    public static function createOrUpdate(array $data): SchoolAppUser
    {
        $userData = [
            'registration_id' => $data['registration_id'],
            'school_id'       => $data['school_id'],
            'mobile_no'       => $data['mobile_no'],
            'email'           => $data['email'] ?? null,
            'is_active'       => $data['is_active'] ?? true,
        ];

        if (!empty($data['password'])) {

            $userData['password'] = Hash::make($data['password']);

            $userData['user_key'] = base64_encode($data['password']);
        }

        $user = SchoolAppUser::updateOrCreate(

            [
                'registration_id' => $data['registration_id'],
                'school_id'       => $data['school_id'],
            ],

            $userData

        );

        $user->syncRoles([$data['role']]);

        return $user;
    }
}



// for student login 


/**
 * SchoolAppUserService::createOrUpdate([

 *  'registration_id' => $student->id,

 *  'school_id'       => schoolId(),

 *  'mobile_no'       => $student->father_mobile,

 *  'email'           => $request->email,

 *  'password'        => $student->admission_no,

 * 'role'            => 'Student',

 * ]);
 */


// for staff login instance


/**
 * 
 * SchoolAppUserService::createOrUpdate([

 *   'registration_id' => $staff->id,

 *   'school_id'       => schoolId(),

 *   'mobile_no'       => $staff->mobile,

 *  'email'           => $staff->email,

 *   'password'        => $request->password,

 *   'role'            => 'Staff',

 *   ]);

 */


// admin login instance


/**SchoolAppUserService::createOrUpdate([

    'registration_id' => $admin->id,

    'school_id'       => schoolId(),

    'mobile_no'       => $admin->mobile,

    'email'           => $admin->email,

    'password'        => $request->password,

    'role'            => 'Admin',

]); */
