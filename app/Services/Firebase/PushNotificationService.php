<?php

namespace App\Services;

use App\Models\DeviceToken;
use App\Models\Notification;
use App\Jobs\SendPushNotificationJob;
use App\Jobs\SendBulkPushNotificationJob;
use App\Jobs\SendTopicNotificationJob;

class PushNotificationService
{
    protected const CHUNK_SIZE = 500;

    public function sendToUser(int $userId, string $title, string $body, array $data = [], ?Notification $notification = null): void
    {
        $tokens = DeviceToken::active()->where('user_id', $userId)->pluck('token');

        if ($tokens->isEmpty()) {
            return;
        }

        $data = $this->withNotificationId($data, $notification);

        foreach ($tokens as $token) {
            SendPushNotificationJob::dispatch(
                token: $token,
                title: $title,
                body: $body,
                data: $data,
                notificationId: $notification?->id,
                userId: $userId
            )->onQueue('notifications');
        }
    }

    public function sendToUsers(array $userIds, string $title, string $body, array $data = [], ?Notification $notification = null): void
    {
        $data = $this->withNotificationId($data, $notification);

        DeviceToken::active()
            ->whereIn('user_id', $userIds)
            ->pluck('token')
            ->chunk(self::CHUNK_SIZE)
            ->each(fn($chunk) => SendBulkPushNotificationJob::dispatch(
                tokens: $chunk->values()->toArray(),
                title: $title,
                body: $body,
                data: $data,
                notificationId: $notification?->id
            )->onQueue('notifications'));
    }

    public function sendToAll(string $title, string $body, array $data = [], ?Notification $notification = null): void
    {
        $data = $this->withNotificationId($data, $notification);

        DeviceToken::active()
            ->pluck('token')
            ->chunk(self::CHUNK_SIZE)
            ->each(fn($chunk) => SendBulkPushNotificationJob::dispatch(
                tokens: $chunk->values()->toArray(),
                title: $title,
                body: $body,
                data: $data,
                notificationId: $notification?->id
            )->onQueue('notifications'));
    }

    public function sendToTopic(string $topic, string $title, string $body, array $data = [], ?Notification $notification = null): void
    {
        SendTopicNotificationJob::dispatch(
            topic: $topic,
            title: $title,
            body: $body,
            data: $this->withNotificationId($data, $notification),
            notificationId: $notification?->id
        )->onQueue('notifications');
    }

    protected function withNotificationId(array $data, ?Notification $notification): array
    {
        if ($notification) {
            $data['notification_id'] = (string) $notification->id;
        }

        return $data;
    }

    public function createAndSend(array $payload): Notification
    {
        $notification = Notification::create([
            'title'        => $payload['title'],
            'body'         => $payload['body'],
            'data'         => $payload['data'] ?? [],
            'target_type'  => $payload['target_type'],
            'target_value' => is_array($payload['target_value'] ?? null)
                ? json_encode($payload['target_value'])
                : ($payload['target_value'] ?? null),
            'status'       => 'processing',
        ]);

        match ($payload['target_type']) {
            'user'  => $this->sendToUser((int) $payload['target_value'], $notification->title, $notification->body, $payload['data'] ?? [], $notification),
            'users' => $this->sendToUsers((array) $payload['target_value'], $notification->title, $notification->body, $payload['data'] ?? [], $notification),
            'topic' => $this->sendToTopic($payload['target_value'], $notification->title, $notification->body, $payload['data'] ?? [], $notification),
            'all'   => $this->sendToAll($notification->title, $notification->body, $payload['data'] ?? [], $notification),
        };

        $notification->update(['status' => 'dispatched']);

        return $notification;
    }
}
