<?php

namespace App\Services\Subscription;

use App\Models\SuperAdmin\SubscriptionPlan\TenantSubscription;
use Carbon\Carbon;

class TenantAccessService
{
    // active
    public function isActive(TenantSubscription $subscription): bool
    {
        return $subscription->status === 'active'
            && Carbon::today()->between(
                Carbon::parse($subscription->start_date),
                Carbon::parse($subscription->end_date)
            );
    }

    // expired
    public function isExpired(TenantSubscription $subscription): bool
    {
        return Carbon::today()->gt(
            Carbon::parse($subscription->end_date)
        );
    }

    // cancelled
    public function isCancelled(TenantSubscription $subscription): bool
    {
        return $subscription->status === 'cancelled';
    }

    // suspended
    public function isSuspended(TenantSubscription $subscription): bool
    {
        return $subscription->status === 'suspended';
    }

    // grace period
    public function hasGracePeriod(
        TenantSubscription $subscription,
        int $days = 7
    ): bool {

        if (!$this->isExpired($subscription)) {
            return false;
        }

        return Carbon::today()->lte(
            Carbon::parse($subscription->end_date)->addDays($days)
        );
    }

    // login
    public function canLogin(TenantSubscription $subscription): bool
    {
        if ($this->isSuspended($subscription)) {
            return false;
        }

        if ($this->isCancelled($subscription)) {
            return false;
        }

        if ($this->isActive($subscription)) {
            return true;
        }

        if ($this->hasGracePeriod($subscription)) {
            return true;
        }

        return false;
    }

    // status
    public function getStatus(TenantSubscription $subscription): string
    {
        if ($this->isSuspended($subscription)) {
            return 'suspended';
        }

        if ($this->isCancelled($subscription)) {
            return 'cancelled';
        }

        if ($this->isActive($subscription)) {
            return 'active';
        }

        if ($this->hasGracePeriod($subscription)) {
            return 'grace_period';
        }

        return 'expired';
    }

    // message
    public function getMessage(TenantSubscription $subscription): string
    {
        return match ($this->getStatus($subscription)) {

            'active' => 'Subscription Active.',

            'grace_period' => 'Subscription expired. You are currently in the grace period.',

            'expired' => 'Subscription expired. Please renew your subscription.',

            'cancelled' => 'Subscription has been cancelled.',

            'suspended' => 'Subscription has been suspended. Please contact support.',

            default => 'Subscription status unavailable.',
        };
    }

    // remaining days
    public function remainingDays(TenantSubscription $subscription): int
    {
        return max(
            0,
            Carbon::today()->diffInDays(
                Carbon::parse($subscription->end_date),
                false
            )
        );
    }

    // trial
    public function isTrial(TenantSubscription $subscription): bool
    {
        return $subscription->is_trial;
    }

    // auto renew
    public function isAutoRenew(TenantSubscription $subscription): bool
    {
        return (bool) $subscription->auto_renew;
    }

    // expired today
    public function expiredToday(TenantSubscription $subscription): bool
    {
        return Carbon::today()->equalTo(
            Carbon::parse($subscription->end_date)
        );
    }

    // trial ending
    public function trialEnding(
        TenantSubscription $subscription,
        int $days = 3
    ): bool {

        if (!$subscription->is_trial || empty($subscription->trial_end_date)) {
            return false;
        }

        return Carbon::today()->gte(
            Carbon::parse($subscription->trial_end_date)->subDays($days)
        );
    }
}
