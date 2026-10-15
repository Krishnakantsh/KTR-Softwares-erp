<?php

namespace App\Services\Subscription;

use App\Models\AllSchool;
use Illuminate\Support\Facades\Log;

class SubscriptionChecker
{

    public function check(AllSchool $company, ?string $productKey): array
    {
        if (blank($productKey)) {
            return $this->fail($company, 'software_missing', 'Software key is required.');
        }

        $today = now()->toDateString();

        $subscription = $company->subscriptions()
            ->with('plan.software')
            ->whereHas('plan.software', fn($q) => $q->where('prod_key', $productKey))
            ->latest('id')
            ->first();

        if (!$subscription) {
            return $this->fail(
                $company,
                'not_found',
                'You do not have an active subscription for this software.',
                $productKey
            );
        }

        $plan     = $subscription->plan;
        $software = $plan?->software;

        if (!$plan || !$software) {
            return $this->fail(
                $company,
                'invalid_config',
                'Invalid subscription configuration.',
                $productKey,
                $subscription
            );
        }

        if ($subscription->status !== 'active') {
            return $this->fail($company, 'inactive', 'Your subscription is not active.', $productKey, $subscription);
        }

        if ($subscription->cancelled_at !== null) {
            return $this->fail($company, 'cancelled', 'Your subscription has been cancelled.', $productKey, $subscription);
        }

        if ($subscription->suspended_at !== null) {
            return $this->fail($company, 'suspended', 'Your subscription has been suspended.', $productKey, $subscription);
        }

        if ($subscription->expired_at !== null) {
            return $this->fail($company, 'expired', 'Your subscription has expired.', $productKey, $subscription);
        }

        if ($subscription->start_date > $today) {
            return $this->fail($company, 'not_started', 'Your subscription has not started yet.', $productKey, $subscription);
        }

        if ($subscription->end_date < $today) {
            return $this->fail($company, 'date_expired', 'Your subscription has expired.', $productKey, $subscription);
        }

        return [
            'ok'           => true,
            'code'         => 'ok',
            'message'      => 'Subscription active.',
            'subscription' => $subscription,
        ];
    }

    private function fail(AllSchool $company, string $code, string $message, ?string $productKey = null, $subscription = null): array
    {
        Log::warning('SUBSCRIPTION CHECK FAILED', [
            'school_id'       => $company->id,
            'subscription_id' => $subscription?->id,
            'product_key'     => $productKey,
            'code'            => $code,
        ]);

        return [
            'ok'           => false,
            'code'         => $code,
            'message'      => $message,
            'subscription' => $subscription,
        ];
    }
}
