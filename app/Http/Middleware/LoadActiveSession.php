<?php

namespace App\Http\Middleware;

use App\Models\AcademicSession;
use App\Services\TenantService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LoadActiveSession
{
    public function handle(Request $request, Closure $next): Response
    {


        $dbname = session()->get('tenant_db');


        TenantService::connect(
            $dbname ?? env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
        );

        $activeSession = AcademicSession::where('status', 1)
            ->where('is_active', 1)
            ->first();

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
