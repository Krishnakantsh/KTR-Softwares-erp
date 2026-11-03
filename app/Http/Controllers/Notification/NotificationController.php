<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotificationRequest;
use App\Models\Notification;
use App\Models\ScheduledNotification;
use App\Services\PushNotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function __construct(protected PushNotificationService $pushService) {}

    public function index(): View
    {
        $notifications = Notification::withCount([
            'logs as sent_count'   => fn($q) => $q->where('status', 'sent'),
            'logs as failed_count' => fn($q) => $q->where('status', 'failed'),
        ])
            ->latest()
            ->paginate(20);

        $scheduled = ScheduledNotification::where('sent', false)
            ->orderBy('scheduled_at')
            ->paginate(10, ['*'], 'scheduled_page');

        return view('admin.notifications.index', compact('notifications', 'scheduled'));
    }

    public function create(): View
    {
        return view('admin.notifications.create');
    }

    public function store(StoreNotificationRequest $request): RedirectResponse
    {
        $targetValue = $request->resolvedTargetValue();

        if ($request->input('send_option') === 'schedule') {
            ScheduledNotification::create([
                'title'        => $request->title,
                'body'         => $request->body,
                'target_type'  => $request->target_type,
                'target_value' => is_array($targetValue) ? json_encode($targetValue) : $targetValue,
                'scheduled_at' => \Carbon\Carbon::parse($request->scheduled_at, $request->timezone)->utc(),
                'timezone'     => $request->timezone,
            ]);

            return redirect()
                ->route('admin.notifications.index')
                ->with('success', 'Notification scheduled successfully.');
        }

        $this->pushService->createAndSend([
            'title'        => $request->title,
            'body'         => $request->body,
            'target_type'  => $request->target_type,
            'target_value' => $targetValue,
        ]);

        return redirect()
            ->route('admin.notifications.index')
            ->with('success', 'Notification sent successfully.');
    }

    public function show(Notification $notification): View
    {
        $notification->loadCount([
            'logs as sent_count'   => fn($q) => $q->where('status', 'sent'),
            'logs as failed_count' => fn($q) => $q->where('status', 'failed'),
        ]);

        $logs = $notification->logs()->latest()->paginate(50);

        return view('admin.notifications.show', compact('notification', 'logs'));
    }

    public function destroyScheduled(ScheduledNotification $scheduled): RedirectResponse
    {
        if ($scheduled->sent) {
            return back()->with('error', 'Cannot delete - already sent.');
        }

        $scheduled->delete();

        return back()->with('success', 'Scheduled notification cancelled.');
    }
}
