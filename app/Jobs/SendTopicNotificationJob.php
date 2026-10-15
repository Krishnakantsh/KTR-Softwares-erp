<?php

namespace App\Jobs;

use App\Models\NotificationLog;
use App\Services\FirebaseService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTopicNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;
    public array $backoff = [10, 30, 60];

    public function __construct(
        public string $topic,
        public string $title,
        public string $body,
        public array $data = [],
        public ?int $notificationId = null,
    ) {}

    public function handle(FirebaseService $firebase): void
    {
        $result = $firebase->sendToTopic($this->topic, $this->title, $this->body, $this->data);

        NotificationLog::create([
            'notification_id' => $this->notificationId,
            'device_token'    => 'topic:' . $this->topic,
            'status'          => $result['status'],
            'error_message'   => $result['error'] ?? null,
            'sent_at'         => now(),
        ]);
    }
}
