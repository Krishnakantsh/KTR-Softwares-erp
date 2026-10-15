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

class SendBulkPushNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;
    public int $timeout = 120;

    public function __construct(
        public array $tokens,
        public string $title,
        public string $body,
        public array $data = [],
        public ?int $notificationId = null,
    ) {}

    public function handle(FirebaseService $firebase): void
    {
        $report = $firebase->sendMulticast($this->tokens, $this->title, $this->body, $this->data);

        $invalidTokens = [];

        foreach ($report->getItems() as $item) {
            $token = $item->target()->value();
            $isSuccess = $item->isSuccess();
            $errorMessage = $isSuccess ? null : $item->error()?->getMessage();

            NotificationLog::create([
                'notification_id' => $this->notificationId,
                'device_token'    => $token,
                'status'          => $isSuccess ? 'sent' : 'failed',
                'error_message'   => $errorMessage,
                'sent_at'         => now(),
            ]);

            if (!$isSuccess && $errorMessage && Str::contains($errorMessage, ['not registered', 'UNREGISTERED', 'NOT_FOUND'])) {
                $invalidTokens[] = $token;
            }
        }

        if (!empty($invalidTokens)) {
            DeviceToken::whereIn('token', $invalidTokens)->update(['is_active' => false]);
        }
    }
}
