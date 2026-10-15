<?php

use App\Models\AllSchool;
use App\Models\SchoolAppUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use App\Models\School;
use App\Models\Student\Student;

if (!function_exists('getSchool')) {

    function getSchool(?int $schoolId = null): ?School
    {
        $schoolId ??= tenantSchoolId();

        if (!$schoolId) {
            return null;
        }

        return School::where('tenant_id', $schoolId)->first();
    }
}

if (!function_exists('getStudent')) {

    function getStudent(?int $studentId = null): ?Student
    {
        $studentId ??= schoolUser()->registration_id;

        if (!$studentId) {
            return null;
        }

        return Student::where('id', $studentId)->first();
    }
}


if (!function_exists('schoolUser')) {

    function schoolUser(): ?SchoolAppUser
    {
        $user = Auth::guard('web')->user();

        return $user instanceof SchoolAppUser ? $user : null;
    }
}


if (!function_exists('superAdmin')) {

    function superAdmin(): ?User
    {
        $user = Auth::guard('super_admin')->user();

        return $user instanceof User ? $user : null;
    }
}

if (!function_exists('currentUser')) {

    function currentUser(): SchoolAppUser|User|null
    {
        return schoolUser() ?? superAdmin();
    }
}

if (!function_exists('schoolId')) {

    function schoolId(): ?int
    {
        return schoolUser()?->school_id;
    }
}

if (!function_exists('loginId')) {

    function loginId(): ?int
    {
        return schoolUser()?->id;
    }
}

if (!function_exists('registrationId')) {

    function registrationId(): ?int
    {
        return schoolUser()?->registration_id;
    }
}

if (!function_exists('loginRole')) {

    function loginRole(): ?string
    {
        return currentUser()?->getRoleNames()->first();
    }
}

if (!function_exists('isSuperAdmin')) {

    function isSuperAdmin(): bool
    {
        return Auth::guard('super_admin')->check();
    }
}

if (!function_exists('isSchoolLogin')) {

    function isSchoolLogin(): bool
    {
        return Auth::guard('web')->check();
    }
}

if (!function_exists('currentSchool')) {

    function currentSchool(): ?AllSchool
    {
        static $school = null;

        if ($school !== null) {
            return $school;
        }

        $user = schoolUser();

        if (!$user) {
            return null;
        }

        return $school = $user->school;
    }
}

if (!function_exists('tenantSchoolId')) {

    function tenantSchoolId(): ?int
    {
        return currentSchool()?->school_id;
    }
}

if (!function_exists('tenantDatabase')) {

    function tenantDatabase(): ?string
    {
        return currentSchool()?->db_name;
    }
}

if (!function_exists('tenantDatabaseUser')) {

    function tenantDatabaseUser(): ?string
    {
        return currentSchool()?->db_user;
    }
}

if (!function_exists('tenantDatabasePassword')) {

    function tenantDatabasePassword(): ?string
    {
        return currentSchool()?->db_pass;
    }
}

if (!function_exists('tenantName')) {

    function tenantName(): ?string
    {
        return currentSchool()?->name;
    }
}





// how to use 


/**
 * schoolUser();              // SchoolAppUser model

 * currentUser();             // SchoolAppUser ya SuperAdmin

 * currentSchool();           // AllSchool model

 * schoolId();                // all_schools.id

 * tenantSchoolId();          // tenant DB schools.id

 * tenantDatabase();          // db_name

 * tenantDatabaseUser();      // db_user

 * tenantDatabasePassword();  // db_pass

 * tenantName();              // School Name

 * registrationId();          // Student/Staff/Admin ID

 * loginRole();               // Admin / Staff / Student / Super Admin

 */
