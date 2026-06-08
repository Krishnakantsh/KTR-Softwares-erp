<?php

namespace App\Http\Middleware;

use App\Models\AcademicSession;
use App\Services\TenantService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LoadActiveSession
{
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * Tenant DB From Session
         */
        
        $dbname = session()->get('tenant_db');

        Log::info('========== LOAD ACTIVE SESSION ==========');

        Log::info('Tenant DB From Session', [
            'tenant_db' => $dbname
        ]);

        Log::info('Default DB Before Connect', [
            'database' => DB::connection()->getDatabaseName()
        ]);

        /**
         * Connect Tenant DB
         */
        TenantService::connect(
            $dbname ?? env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        );

        /**
         * Current DB After Connect
         */
        Log::info('DB After Tenant Connect', [
            'database' => DB::connection()->getDatabaseName()
        ]);

        /**
         * Fetch Active Session
         */
        $activeSession = AcademicSession::where('status', 1)
            ->where('is_active', 1)
            ->first();

        Log::info('Fetched Active Session', [
            'session' => $activeSession
        ]);

        /**
         * Global Share
         */
        $request->merge([
            'active_session' => $activeSession
        ]);

        config([
            'app.active_session' => $activeSession
        ]);

        app()->instance('active_session', $activeSession);

        session([
            'active_session' => $activeSession
        ]);

        Log::info('Final Active Session Bound Successfully');

        return $next($request);
    }
}
