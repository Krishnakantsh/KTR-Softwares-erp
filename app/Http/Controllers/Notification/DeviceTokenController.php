<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeviceTokenRequest;
use App\Models\DeviceToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeviceTokenController extends Controller
{
    public function store(StoreDeviceTokenRequest $request): JsonResponse
    {
        $deviceToken = DeviceToken::registerForUser(
            userId: $request->user()->id,
            token: $request->token,
            deviceType: $request->device_type,
            deviceId: $request->device_id,
        );

        return response()->json([
            'message' => 'Device token registered.',
            'data'    => $deviceToken,
        ], 201);
    }

    public function destroy(Request $request): JsonResponse
    {
        $request->validate(['token' => ['required', 'string']]);

        // Only deactivate if it belongs to the authenticated user
        DeviceToken::where('token', $request->token)
            ->where('user_id', $request->user()->id)
            ->update(['is_active' => false]);

        return response()->json(['message' => 'Device token deactivated.']);
    }

    /** List all active devices for the authenticated user (useful for a "manage devices" screen). */
    public function index(Request $request): JsonResponse
    {
        $devices = DeviceToken::active()
            ->where('user_id', $request->user()->id)
            ->latest('last_used_at')
            ->get(['id', 'device_type', 'device_id', 'last_used_at']);

        return response()->json(['data' => $devices]);
    }
}
