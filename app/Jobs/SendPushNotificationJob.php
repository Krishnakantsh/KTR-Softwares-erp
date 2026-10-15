<?php

namespace App\Jobs;

use App\Models\DeviceToken;
use App\Models\NotificationLog;
use App\Services\FirebaseService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SendPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public array $backoff = [10, 30, 60];

    public function __construct(
        public string $token,
        public string $title,
        public string $body,
        public array $data = [],
        public ?int $notificationId = null,
        public ?int $userId = null,
    ) {}

    public function handle(FirebaseService $firebase): void
    {
        $result = $firebase->sendToToken($this->token, $this->title, $this->body, $this->data);

        NotificationLog::create([
            'notification_id' => $this->notificationId,
            'user_id'         => $this->userId,
            'device_token'    => $this->token,
            'status'          => $result['status'],
            'error_message'   => $result['error'] ?? null,
            'sent_at'         => now(),
        ]);

        if ($result['status'] === 'failed' && $this->isTokenInvalid($result['error'] ?? '')) {
            DeviceToken::where('token', $this->token)->update(['is_active' => false]);
        }
    }

    protected function isTokenInvalid(string $error): bool
    {
        return Str::contains($error, ['UNREGISTERED', 'NOT_FOUND', 'InvalidRegistration']);
    }

    public function failed(\Throwable $exception): void
    {
        Log::error("SendPushNotificationJob permanently failed for token {$this->token}: {$exception->getMessage()}");

        NotificationLog::create([
            'notification_id' => $this->notificationId,
            'user_id'         => $this->userId,
            'device_token'    => $this->token,
            'status'          => 'failed',
            'error_message'   => $exception->getMessage(),
            'sent_at'         => now(),
        ]);
    }
}
