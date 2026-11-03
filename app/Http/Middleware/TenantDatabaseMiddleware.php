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
    /**
     * Handle an incoming request for both Web (Session-based) and API (JWT-based) tenants.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // =========================================================================
            // 1. WEB REQUEST HANDLING (Session-Based Multitenancy)
            // =========================================================================
            if (!$request->is('api/*')) {

                // Agar session me tenant database set nahi hai, toh default connection par reset karo
                if (!session()->has('tenant_db')) {
                    TenantService::reset();
                    return $next($request);
                }

                // Session se credentials nikaal kar tenant database se connect karo
                TenantService::connect(
                    session('tenant_db'),
                    session('tenant_db_user'),
                    session('tenant_db_password')
                );

                return $next($request);
            }

            // =========================================================================
            // 2. API REQUEST HANDLING (Token/JWT-Based Multitenancy)
            // =========================================================================

            // Public API routes ko bypass karo (JWT authentication ki zaroorat nahi hai)
            if ($request->is('api/v1/login') || $request->is('api/v1/register')) {
                return $next($request);
            }

            // Protected Routes: API guard ke through user verify karo
            $user = $request->user('api');

            if (!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Unauthenticated.',
                ], 401);
            }

            // JWT token payload se tenant database ka naam extract karo
            $dbName = auth('api')->payload()->get('db');

            // Token me database claim exist karta hai ya nahi check karo
            if (!is_string($dbName) || trim($dbName) === '') {
                return response()->json([
                    'status'  => false,
                    'message' => 'Tenant database claim missing.',
                ], 403);
            }

            // Central database ('mysql') se tenant/school details verify karo
            $school = DB::connection('mysql')
                ->table('all_schools')
                ->where('db_name', $dbName)
                ->first();

            if (!$school) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Invalid tenant.',
                ], 403);
            }

            // Verified tenant database se connection establish karo
            TenantService::connect(
                $school->db_name,
                $school->db_user ?? null,
                $school->db_pass ?? null
            );

            // Request attributes me tenant context attach karo taaki controllers me directly access ho sake
            $request->attributes->set('tenant_school', $school);

            Log::info('API tenant database connected successfully', [
                'db' => $school->db_name,
            ]);

            return $next($request);

        } catch (Throwable $e) {
            // Kisi bhi tarah ka connection fail ya exception aane par log record karo
            Log::error('Tenant database connection failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Web request ke case me clean JSON response ke bajaye redirect ya generic error de sakte hain,
            // par API aur centralized handling ke liye JSON error return kiya gaya hai:
            return response()->json([
                'status'  => false,
                'message' => 'Tenant database connection failed.',
            ], 500);
        }
    }
}