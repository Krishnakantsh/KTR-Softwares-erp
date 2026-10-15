<?php

namespace App\Http\Middleware;

use App\Models\AllSchool;
use App\Services\Subscription\SubscriptionChecker;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class EnsureActiveSubscription
{
    public function __construct(private SubscriptionChecker $checker) {}

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user('api');

        if (!$user) {
            return response()->json(['status' => false, 'message' => 'Unauthenticated.'], 401);
        }

        $software = JWTAuth::parseToken()->getPayload()->get('software');

        $result = Cache::remember("sub_check:{$user->school_id}:{$software}", 300, function () use ($user, $software) {
            $company = AllSchool::find($user->school_id);

            if (!$company || !$company->is_active) {
                return ['ok' => false, 'code' => 'school_inactive', 'message' => 'School inactive or not found.'];
            }

            $r = $this->checker->check($company, $software);
            unset($r['subscription']); 

            return $r;
        });

        if (!$result['ok']) {
            return response()->json([
                'status'  => false,
                'code'    => $result['code'],
                'message' => $result['message'],
            ], 403);
        }

        return $next($request);
    }
}