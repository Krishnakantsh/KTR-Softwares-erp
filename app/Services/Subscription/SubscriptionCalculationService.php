<?php

namespace App\Services\Subscription;

use Carbon\Carbon;

class SubscriptionCalculationService
{
    // end date
    public function calculateEndDate(string $billingCycle, $startDate): Carbon
    {
        $startDate = Carbon::parse($startDate);

        return match ($billingCycle) {
            'monthly'      => $startDate->copy()->addMonth(),
            'quarterly'    => $startDate->copy()->addMonths(3),
            'half_yearly'  => $startDate->copy()->addMonths(6),
            'yearly'       => $startDate->copy()->addYear(),
            default        => $startDate->copy()->addMonth(),
        };
    }

    // final amount
    public function calculateFinalAmount(
        float $amount,
        float $discount = 0,
        float $tax = 0
    ): float {

        return ($amount - $discount) + $tax;
    }

    // trial end date
    public function calculateTrialEndDate($startDate, int $days): Carbon
    {
        return Carbon::parse($startDate)->addDays($days);
    }

    // remaining days
    public function remainingDays($endDate): int
    {
        return now()->diffInDays(Carbon::parse($endDate), false);
    }

    // expired
    public function isExpired($endDate): bool
    {
        return Carbon::parse($endDate)->lt(now());
    }

    // active
    public function isActive($startDate, $endDate): bool
    {
        $today = now();

        return $today->between(
            Carbon::parse($startDate),
            Carbon::parse($endDate)
        );
    }

    // grace end date
    public function graceEndDate($endDate, int $days = 7): Carbon
    {
        return Carbon::parse($endDate)->addDays($days);
    }

    // extend
    public function extendSubscription($endDate, string $billingCycle): Carbon
    {
        $endDate = Carbon::parse($endDate);

        return match ($billingCycle) {
            'monthly'      => $endDate->copy()->addMonth(),
            'quarterly'    => $endDate->copy()->addMonths(3),
            'half_yearly'  => $endDate->copy()->addMonths(6),
            'yearly'       => $endDate->copy()->addYear(),
            default        => $endDate->copy()->addMonth(),
        };
    }

    // tax amount
    public function calculateTaxAmount(float $amount, float $taxPercentage): float
    {
        return ($amount * $taxPercentage) / 100;
    }

    // discount amount
    public function calculateDiscountAmount(float $amount, float $discountPercentage): float
    {
        return ($amount * $discountPercentage) / 100;
    }

    // next renewal date
    public function nextRenewalDate(string $billingCycle, $startDate): Carbon
    {
        return $this->calculateEndDate($billingCycle, $startDate);
    }
}
