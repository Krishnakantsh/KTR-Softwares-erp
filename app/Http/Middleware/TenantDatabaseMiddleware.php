<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\TenantService;
use Illuminate\Support\Facades\Log;

class TenantDatabaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {


            $db_name = session()->get('tenant_db');

            Log::warning('Tenant DB Searching Start ', [
                'db_name' => $db_name,
                'tenant_db_user' => session()->get('tenant_db_user'),
                'tenant_db_password' => session()->get('tenant_db_password'),

            ]);
            if (!session()->has('tenant_db')) {

                Log::warning('Tenant DB not found in session', [
                    'session' => session()->all(),
                    'url' => $request->fullUrl()
                ]);
                TenantService::reset();

                return $next($request);
            }

            $dbName = session('tenant_db');
            $dbUser = session('tenant_db_user');
            $dbPass = session('tenant_db_password');

            Log::info('Tenant DB Switching Start', [
                'db' => $dbName,
                'user' => $dbUser
            ]);

            // 🔗 Connect tenant DB
            TenantService::connect($dbName, $dbUser, $dbPass);

            Log::info('Tenant DB Connected Successfully', [
                'db' => $dbName
            ]);
        } catch (\Exception $e) {

            Log::error('Tenant DB Connection Failed', [
                'error' => $e->getMessage(),
                'db' => session('tenant_db'),
                'trace' => $e->getTraceAsString()
            ]);

            // ❗ Optional: abort or continue
            return response()->json([
                'status' => false,
                'message' => 'Tenant database connection failed'
            ], 500);
        }

        return $next($request);
    }
}
