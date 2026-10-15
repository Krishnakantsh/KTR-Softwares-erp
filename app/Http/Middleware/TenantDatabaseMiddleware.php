<?php

namespace App\Http\Middleware;

use App\Services\TenantService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class TenantDatabaseMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            /*
             * WEB REQUEST
             * Existing session-based functionality preserve karo.
             */
            if (!$request->is('api/*')) {

                if (!session()->has('tenant_db')) {
                    TenantService::reset();

                    return $next($request);
                }

                TenantService::connect(
                    session('tenant_db'),
                    session('tenant_db_user'),
                    session('tenant_db_password')
                );

                return $next($request);
            }

            /*
             * API REQUEST
             * auth:api is middleware that must execute first.
             */
            $user = $request->user('api');

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthenticated.',
                ], 401);
            }

            /*
             * Example for tymon/jwt-auth compatible guards.
             * Confirm the claim name against your login implementation.
             */
            $dbName = auth('api')->payload()->get('db');

            if (!is_string($dbName) || trim($dbName) === '') {
                return response()->json([
                    'status' => false,
                    'message' => 'Tenant database claim missing.',
                ], 403);
            }

            /*
             * Verify tenant against MASTER database.
             * Adjust column names and active-status checks to your schema.
             */
            $school = DB::connection('mysql')
                ->table('all_schools')
                ->where('db_name', $dbName)
                ->first();

            if (!$school) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid tenant.',
                ], 403);
            }

            /*
             * Credentials come from trusted master configuration,
             * never directly from request input.
             */
            TenantService::connect(
                $school->db_name,
                $school->db_user ?? null,
                $school->db_pass ?? null
            );

            $request->attributes->set('tenant_school', $school);

            Log::info('API tenant database connected', [
                'db' => $school->db_name,
            ]);

            return $next($request);
        } catch (Throwable $e) {
            Log::error('Tenant database connection failed', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Tenant database connection failed.',
            ], 500);
        }
    }
}

// namespace App\Http\Middleware;

// use Closure;
// use App\Services\TenantService;
// use Illuminate\Support\Facades\Log;

// class TenantDatabaseMiddleware
// {
//     public function handle($request, Closure $next)
//     {

//         try {


//             $db_name = session()->get('tenant_db');

//             if (!session()->has('tenant_db')) {

//                 TenantService::reset();

//                 return $next($request);
//             }

//             $dbName = session('tenant_db');
//             $dbUser = session('tenant_db_user');
//             $dbPass = session('tenant_db_password');

//             TenantService::connect($dbName, $dbUser, $dbPass);

//             Log::info('Tenant DB Connected Successfully', [
//                 'db' => $dbName
//             ]);
//         } catch (\Exception $e) {

//             return response()->json([
//                 'status' => false,
//                 'message' => 'Tenant database connection failed'
//             ], 500);
//         }

//         return $next($request);
//     }
// }
