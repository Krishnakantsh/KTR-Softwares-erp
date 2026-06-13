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

            if (!session()->has('tenant_db')) {

                TenantService::reset();

                return $next($request);
            }

            $dbName = session('tenant_db');
            $dbUser = session('tenant_db_user');
            $dbPass = session('tenant_db_password');

            TenantService::connect($dbName, $dbUser, $dbPass);

            Log::info('Tenant DB Connected Successfully', [
                'db' => $dbName
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Tenant database connection failed'
            ], 500);
        }

        return $next($request);
    }
}
