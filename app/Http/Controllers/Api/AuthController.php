<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AllSchool;
use App\Models\SchoolAppUser;
use App\Services\Subscription\SubscriptionChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'type' => ['required', 'integer', 'in:1,2'],
            'software' => ['required', 'string'],
        ]);

        $login = $validated['username'];

        $user = SchoolAppUser::query()
            ->where(function ($query) use ($login) {
                $query->where('mobile_no', $login)
                    ->orWhere('email', $login);
            })
            ->first();

        // Validate credentials first.
        if (
            !$user ||
            !Hash::check($validated['password'], $user->password)
        ) {
            throw ValidationException::withMessages([
                'username' => [
                    'The provided credentials are incorrect.',
                ],
            ]);
        }

        // Get the user's role.
        $role = $user->getRoleNames()->first();

        // Map login type to allowed role.
        $allowedRoles = [
            1 => 'Admin',
            2 => 'Staff',
        ];

        $expectedRole = strtolower($allowedRoles[$validated['type']]);

        // Validate role according to selected login type.
        if (strtolower($role ?? '') !== $expectedRole) {
            return response()->json([
                'status' => false,
                'message' => 'Please select a valid login type.',
            ], 403);
        }

        // Fetch company only after validating user credentials.
        $company = AllSchool::find($user->school_id);


        if (!$company->is_active) {
            return response()->json(['status' => false, 'message' => 'Inactive School.'], 403);
        }

        $result = app(SubscriptionChecker::class)
            ->check($company, $validated['software']);

        if (!$result['ok']) {
            return response()->json([
                'status'  => false,
                'code'    => $result['code'],
                'message' => $result['message'],
            ], 403);
        }

        $subscription = $result['subscription'];

        // Generate JWT only after successful role validation.
        $token = JWTAuth::claims([
            'role' => $role,
            'db' => $company->db_name ?? null,
            'company' => $company->name ?? '',
            'email' => $company->email ?? '',
            'phone' => $company->phone ?? '',
            'type' => (int) $validated['type'],
            'software' => $validated['software'],
            'subscription_id' => $subscription->id,
            'plan_id'         => $subscription->subscription_plan_id,
            'plan_end_date'   => (string) $subscription->end_date,
        ])->fromUser($user);

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => [
                'id' => $user->getKey(),
                'name' => $user->name ?? null,
                'email' => $user->email,
                'mobile_no' => $user->mobile_no,
                'role' => $role,
                'company' => $company->name ?? '',
            ],
        ]);
    }
    public function user(Request $request)
    {
        $user = $request->user('api');

        return response()->json([
            'user' => [
                'id' => $user->getKey(),
                'name' => $user->name ?? null,
                'email' => $user->email,
                'mobile_no' => $user->mobile_no,
                'role' => $user->getRoleNames()->first(),
            ],
        ]);
    }

    /**
     * Invalidate the current JWT.
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'message' => 'Logged out successfully.',
            'status'  => true
        ]);
    }

    /**
     * Refresh the current JWT.
     */


    public function refresh()
    {
        $payload = JWTAuth::parseToken()->getPayload();
        $user    = JWTAuth::parseToken()->authenticate();
        $company = AllSchool::find($user->school_id);

        $result = $company
            ? app(SubscriptionChecker::class)->check($company, $payload->get('software'))
            : ['ok' => false, 'code' => 'no_school', 'message' => 'School not found.'];

        if (!$result['ok']) {
            return response()->json(['status' => false, 'code' => $result['code'], 'message' => $result['message']], 403);
        }

        $token = JWTAuth::refresh(JWTAuth::getToken());

        return response()->json([
            'message' => 'Token refreshed successfully.',
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')
                ->factory()
                ->getTTL() * 60,
        ]);
    }
}
