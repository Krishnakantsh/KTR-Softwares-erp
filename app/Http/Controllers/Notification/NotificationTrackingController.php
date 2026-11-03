<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotificationLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class NotificationTrackingController extends Controller
{
    public function track(Request $request): JsonResponse
    {
        $request->validate([
            'notification_id' => ['required', 'integer', 'exists:notifications,id'],
            'event'           => ['required', 'in:opened,clicked'],
        ]);

        $log = NotificationLog::where('notification_id', $request->notification_id)
            ->where('user_id', $request->user()->id)
            ->where('status', 'sent')
            ->latest('sent_at')
            ->first();

        if (!$log) {
            return response()->json(['message' => 'No matching log found.'], 404);
        }

        $request->event === 'opened' ? $log->markOpened() : $log->markClicked();

        return response()->json(['message' => 'Tracked.']);
    }
}
