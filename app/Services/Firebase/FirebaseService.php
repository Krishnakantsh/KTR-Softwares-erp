<?php

namespace App\Services;

use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Kreait\Firebase\Messaging\MulticastSendReport;
use Illuminate\Support\Facades\Log;

class FirebaseService
{
    protected Messaging $messaging;

    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function sendToToken(string $token, string $title, string $body, array $data = [], ?string $image = null): array
    {
        $message = CloudMessage::new()
            ->withToken($token)
            ->withNotification(FirebaseNotification::create($title, $body, $image))
            ->withData($this->normalizeData($data));

        try {
            $this->messaging->send($message);
            return ['status' => 'sent', 'token' => $token];
        } catch (\Throwable $e) {
            Log::warning("FCM send failed for token: {$token}", ['error' => $e->getMessage()]);
            return ['status' => 'failed', 'token' => $token, 'error' => $e->getMessage()];
        }
    }

    public function sendMulticast(array $tokens, string $title, string $body, array $data = [], ?string $image = null): MulticastSendReport
    {
        $message = CloudMessage::new()
            ->withNotification(FirebaseNotification::create($title, $body, $image))
            ->withData($this->normalizeData($data));

        return $this->messaging->sendMulticast($message, $tokens);
    }

    public function sendToTopic(string $topic, string $title, string $body, array $data = [], ?string $image = null): array
    {
        $message = CloudMessage::new()
            ->withTopic($topic)
            ->withNotification(FirebaseNotification::create($title, $body, $image))
            ->withData($this->normalizeData($data));

        try {
            $this->messaging->send($message);
            return ['status' => 'sent', 'topic' => $topic];
        } catch (\Throwable $e) {
            Log::error("FCM topic send failed: {$topic}", ['error' => $e->getMessage()]);
            return ['status' => 'failed', 'topic' => $topic, 'error' => $e->getMessage()];
        }
    }

    public function subscribeToTopic(array $tokens, string $topic): void
    {
        $this->messaging->subscribeToTopic($topic, $tokens);
    }

    public function unsubscribeFromTopic(array $tokens, string $topic): void
    {
        $this->messaging->unsubscribeFromTopic($topic, $tokens);
    }

    protected function normalizeData(array $data): array
    {
        return array_map(fn($v) => is_scalar($v) ? (string) $v : json_encode($v), $data);
    }
}
