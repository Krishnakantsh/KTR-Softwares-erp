<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\TenantInitializer;
use App\Services\TenantService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{

    public function create(): View
    {
        return view('Frontend/Authentication/login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {


        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->hasRole('Admin')) {

            $company = DB::table('all_schools')
                ->where('username', $request->email)
                ->first();

            if (!$company) {
                return $this->logoutWithMessage($request, 'Company not found');
            }

            if (!$company->db_name) {
                return $this->logoutWithMessage($request, 'Invalid company configuration');
            }

            if (!$company->is_active) {
                return $this->logoutWithMessage($request, 'Inactive company');
            }

            $now = Carbon::now();
            $validUpto = Carbon::parse($company->valid_upto);
            $graceEndDate = $validUpto->copy()->addDays($company->grace_period);

            if ($now->greaterThan($graceEndDate)) {
                return $this->logoutWithMessage($request, 'Your plan has expired');
            }
            
            try {
                TenantService::connect(
                    $company->db_name,
                    $company->db_user ?? env('DB_USERNAME'),
                    $company->db_pass ?? env('DB_PASSWORD')
                );

                if (Schema::connection('tenant')->hasTable('schools')) {

                    TenantInitializer::syncSchool($company);
                };
            } catch (\Exception $e) {
                Log::error('Tenant DB Error: ' . $e->getMessage());
                return $this->logoutWithMessage($request, 'Database connection failed');
            }
            $request->session()->put([
                'tenant_db' => $company->db_name,
                'tenant_db_user' => $company->db_user ?? env('DB_USERNAME'),
                'tenant_db_password' => $company->db_pass ?? env('DB_PASSWORD'),
            ]);

            $request->session()->save();

            return redirect()->intended(route('dashboard', absolute: false));
        }
        return redirect()->intended(route('dashboard', absolute: false));
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->forget([
            'tenant_db',
            'tenant_db_user',
            'tenant_db_password'
        ]);

        TenantService::reset();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


    private function logoutWithMessage(Request $request, string $message)
    {

        Auth::guard('web')->logout();

        $request->session()->forget([
            'tenant_db',
            'tenant_db_user',
            'tenant_db_password'
        ]);


        TenantService::reset();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->with('message', $message);
    }
}
