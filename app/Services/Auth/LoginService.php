<?php

namespace App\Services\Auth;

use App\Models\AllSchool;
use App\Models\SchoolAppUser;

use App\Models\User;
use App\Services\Subscription\SubscriptionChecker;
use App\Services\TenantInitializer;
use App\Services\TenantService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class LoginService
{




    // login process start here for ['Super Admin', 'Admin', 'Staff', 'Student']

    // Separate Login Type - 1 => Super Admin, 2 => Admin,Staff and Students

    public function login(Request $request): RedirectResponse
    {
        if (method_exists($request, 'ensureIsNotRateLimited')) {
            $request->ensureIsNotRateLimited();
        }

        $login = trim($request->login);
        $password = $request->password;
        $software = $request->software ?? null;

        $type = (int) $request->type;

        Log::info('LOGIN ATTEMPT START', [
            'login' => $login,
            'type' => $type,
            'default_connection_before' => DB::getDefaultConnection(),
            'session_id' => $request->session()->getId(),
            'has_tenant_db_in_session' => $request->session()->has('tenant_db'),
        ]);


        if ($type === 1) {
            return $this->loginSuperAdmin($request, $login, $password);
        }

        return $this->loginSchoolUser(
            $request,
            $login,
            $password,
            $type,
            $software
        );
    }

    // Super Admin Login

    private function loginSuperAdmin(
        Request $request,
        string $login,
        string $password
    ): RedirectResponse {

        Log::info('SUPER ADMIN LOGIN: start', ['login' => $login]);

        $superAdmin = $this->findSuperAdmin($login);

        if (!$superAdmin) {

            Log::warning('SUPER ADMIN LOGIN: user not found', ['login' => $login]);

            $request->hitRateLimiter();

            throw ValidationException::withMessages([
                'login' => __('auth.failed'),
            ]);
        }

        Log::info('SUPER ADMIN LOGIN: user found', [
            'user_id' => $superAdmin->id,
            'email' => $superAdmin->email,
        ]);

        if (!Hash::check($password, $superAdmin->password)) {

            Log::warning('SUPER ADMIN LOGIN: password mismatch', [
                'user_id' => $superAdmin->id,
            ]);

            $request->hitRateLimiter();

            throw ValidationException::withMessages([
                'login' => __('auth.failed'),
            ]);
        }

        if (!$this->validateLoginType(1, $superAdmin)) {

            Log::warning('SUPER ADMIN LOGIN: invalid login type / role mismatch', [
                'user_id' => $superAdmin->id,
                'roles' => method_exists($superAdmin, 'getRoleNames') ? $superAdmin->getRoleNames() : null,
            ]);

            return $this->logoutWithMessage(
                $request,
                'Please select a valid login type.',
                'info'
            );
        }

        Auth::guard('super_admin')->login(
            $superAdmin,
            $request->boolean('remember')
        );

        $request->session()->regenerate();

        $request->clearRateLimiter();

        Log::info('SUPER ADMIN LOGIN: success, redirecting', [
            'user_id' => $superAdmin->id,
            'redirect_to' => route('superAdmin.dashboard', absolute: false),
            'session_id' => $request->session()->getId(),
        ]);

        return redirect()->intended(route('superAdmin.dashboard', absolute: false));
    }

    // ['Admin', 'Staff', 'Student'] - Login

    private function loginSchoolUser(
        Request $request,
        string $login,
        string $password,
        $type,
        ?string $productKey = null
    ): RedirectResponse {

        Log::info('SCHOOL USER LOGIN: start', [
            'login' => $login,
            'type' => $type,
            'default_connection' => DB::getDefaultConnection(),
        ]);

        $user = $this->findSchoolUser($login);

        if (!$user) {

            Log::warning('SCHOOL USER LOGIN: user not found', [
                'login' => $login,
                'default_connection' => DB::getDefaultConnection(),
            ]);

            $request->hitRateLimiter();

            throw ValidationException::withMessages([
                'login' => __('auth.failed'),
            ]);
        }

        Log::info('SCHOOL USER LOGIN: user found', [
            'user_id' => $user->id,
            'email' => $user->email,
            'school_id' => $user->school_id,
            'connection_used' => $user->getConnectionName(),
        ]);

        if (!Hash::check($password, $user->password)) {

            Log::warning('SCHOOL USER LOGIN: password mismatch', [
                'user_id' => $user->id,
            ]);

            $request->hitRateLimiter();

            throw ValidationException::withMessages([
                'login' => __('auth.failed'),
            ]);
        }

        if (!$user->is_active) {

            Log::warning('SCHOOL USER LOGIN: account inactive', [
                'user_id' => $user->id,
            ]);

            return $this->logoutWithMessage(
                $request,
                'Account inactive.',
                'error'
            );
        }

        if (!$this->validateLoginType($type, $user)) {

            Log::warning('SCHOOL USER LOGIN: invalid login type / role mismatch', [
                'user_id' => $user->id,
                'type_submitted' => $type,
                'roles' => method_exists($user, 'getRoleNames') ? $user->getRoleNames() : null,
            ]);

            return $this->logoutWithMessage(
                $request,
                'Please select a valid login type.',
                'info'
            );
        }


        $company = AllSchool::where('id', $user->school_id)->first();

        Log::info('SCHOOL USER LOGIN: company lookup', [
            'school_id' => $user->school_id,
            'found' => (bool) $company,
            'db_name' => $company->db_name ?? null,
            'is_active' => $company->is_active ?? null,
        ]);

        if (!$company) {

            Log::warning('SCHOOL USER LOGIN: school not found', [
                'school_id' => $user->school_id,
            ]);

            return $this->logoutWithMessage(
                $request,
                'School not found.',
                'error'
            );
        }

        if (!$company->is_active) {

            Log::warning('SCHOOL USER LOGIN: school inactive', [
                'school_id' => $company->id,
                'db_name' => $company->db_name,
            ]);

            return $this->logoutWithMessage(
                $request,
                'Inactive School.',
                'error'
            );
        }

        $result = app(SubscriptionChecker::class)
            ->check($company, $productKey);

        if (!$result['ok']) {
            return $this->logoutWithMessage($request, $result['message'], 'error');
        }

        if (!$this->connectTenant($company, $request)) {

            Log::error('SCHOOL USER LOGIN: tenant connection failed', [
                'school_id' => $company->id,
                'db_name' => $company->db_name,
            ]);

            return $this->logoutWithMessage(
                $request,
                'Database connection failed.',
                'error'
            );
        }

        Auth::guard('web')->login(
            $user,
            $request->boolean('remember')
        );

        $request->session()->regenerate();

        $request->session()->put([
            'school_id'       => $user->school_id,
            'registration_id' => $user->registration_id,
            'login_role'      => $user->getRoleNames()->first(),
        ]);

        $request->clearRateLimiter();

        $role = auth()->user()->getRoleNames()->first();

        $redirect = match ($role) {
            'Admin'   => 'dashboard',
            'Student' => 'app.student.dashboard',
            'Staff' => 'staff.dashboard',
            default   => 'dashboard',
        };

        return redirect()->intended(route($redirect, absolute: false));
    }

    // tenant connection handle here 

    private function connectTenant($company, Request $request): bool
    {
        try {
            TenantService::connect(
                $company->db_name,
                $company->db_user ?? env('DB_USERNAME'),
                $company->db_pass ?? env('DB_PASSWORD')
            );


            if (Schema::connection('tenant')->hasTable('schools')) {
                TenantInitializer::syncSchool($company);
            } else {
                Log::warning('CONNECT TENANT: schools table not found on tenant DB', [
                    'db_name' => $company->db_name,
                ]);
            }

            $request->session()->put([
                'tenant_db'          => $company->db_name,
                'tenant_db_user'     => $company->db_user ?? env('DB_USERNAME'),
                'tenant_db_password' => $company->db_pass ?? env('DB_PASSWORD'),
            ]);

            $request->session()->save();

            return true;
        } catch (\Exception $e) {

            Log::error('CONNECT TENANT: exception', [
                'message' => $e->getMessage(),
                'school'  => $company->id ?? null,
                'db_name' => $company->db_name ?? null,
                'trace'   => $e->getTraceAsString(),
            ]);

            return false;
        }
    }

    // find super admin instance

    private function findSuperAdmin(string $login): ?User
    {
        Log::debug('FIND SUPER ADMIN: querying', [
            'login' => $login,
            'default_connection' => DB::getDefaultConnection(),
        ]);

        return User::where(function ($query) use ($login) {

            $query->where('email', $login);
            // ->orWhere('phone', $login);
        })->first();
    }

    // find school app user - ['Admin' , 'Staff', 'Student']

    private function findSchoolUser(string $login): ?SchoolAppUser
    {
        Log::debug('FIND SCHOOL USER: querying', [
            'login' => $login,
            'default_connection' => DB::getDefaultConnection(),
            'model_connection' => (new SchoolAppUser())->getConnectionName(),
        ]);

        return SchoolAppUser::query()
            ->where(function ($query) use ($login) {

                $query->where('mobile_no', $login)
                    ->orWhere('email', $login);
            })
            ->first();
    }

    // Validate login type here 

    private function validateLoginType(int $type, $user): bool
    {
        $roles = [
            1 => 'Super Admin',
            2 => 'Admin',
            3 => 'Staff',
            4 => 'Student',
        ];



        if (!isset($roles[$type])) {

            Log::warning('VALIDATE LOGIN TYPE: unknown type submitted', [
                'type' => $type,
            ]);

            return false;
        }

        $result = $user->hasRole($roles[$type]);

        Log::debug('VALIDATE LOGIN TYPE: checked', [
            'type' => $type,
            'expected_role' => $roles[$type],
            'user_id' => $user->id ?? null,
            'passed' => $result,
        ]);

        return $result;
    }

    // special logout system with no redirect any route or url

    private function logoutWithMessage(
        Request $request,
        string $message,
        string $type
    ): RedirectResponse {

        Auth::guard('web')->logout();
        Auth::guard('super_admin')->logout();

        $request->session()->forget([
            'tenant_db',
            'tenant_db_user',
            'tenant_db_password',
            'school_id',
            'registration_id',
            'login_role'
        ]);

        TenantService::reset();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return back()->with($type, $message);
    }

    // main logout system 

    public function logout(Request $request): RedirectResponse
    {

        $role = auth()->user()->getRoleNames()->first();

        $redirect = '';

        if ($role == 'Admin') {
            $redirect = 'login';
        } elseif ($role == 'Staff') {
            $redirect = 'login';
        } elseif ($role == 'Student') {
            $redirect = 'app.login';
        } else {
            $redirect = 'login';
        }

        Auth::guard('web')->logout();
        Auth::guard('super_admin')->logout();

        $request->session()->forget([
            'tenant_db',
            'tenant_db_user',
            'tenant_db_password',
            'school_id',
            'registration_id',
            'login_role'
        ]);

        TenantService::reset();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended(route($redirect, absolute: false));
    }

    private function isEmail(string $login): bool
    {
        return filter_var($login, FILTER_VALIDATE_EMAIL) !== false;
    }
}
