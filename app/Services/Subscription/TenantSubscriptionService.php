<?php

namespace App\Services\Subscription;

use App\Models\SuperAdmin\SubscriptionPlan\TenantSubscription;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TenantSubscriptionService
{
    protected $calculationService;
    protected $historyService;

    public function __construct(
        SubscriptionCalculationService $calculationService,
        SubscriptionHistoryService $historyService
    ) {
        $this->calculationService = $calculationService;
        $this->historyService = $historyService;
    }

    public function create(array $data): TenantSubscription
    {
        return DB::transaction(function () use ($data) {

            $startDate = Carbon::parse($data['start_date']);

            $endDate = $this->calculationService->calculateEndDate(
                $data['billing_cycle'],
                $startDate
            );

            $finalAmount = $this->calculationService->calculateFinalAmount(
                $data['amount'] ?? 0,
                $data['discount'] ?? 0,
                $data['tax'] ?? 0
            );

            $subscription = TenantSubscription::create([

                'tenant_id' => $data['tenant_id'],

                'subscription_plan_id' => $data['subscription_plan_id'],

                'billing_cycle' => $data['billing_cycle'],

                'activated_at' => now(),

                'start_date' => $startDate,

                'end_date' => $endDate,

                'is_trial' => $data['is_trial'] ?? false,

                'trial_start_date' => $data['trial_start_date'] ?? null,

                'trial_end_date' => $data['trial_end_date'] ?? null,

                'amount' => $data['amount'] ?? 0,

                'discount' => $data['discount'] ?? 0,

                'tax' => $data['tax'] ?? 0,

                'final_amount' => $finalAmount,

                'status' => $data['status'] ?? 'active',

                'auto_renew' => $data['auto_renew'] ?? false,

                'renewal_count' => 0,

                'remarks' => $data['remarks'] ?? null,

            ]);

            if ($subscription->is_trial) {

                $this->historyService->trialStarted($subscription);
            } else {

                $this->historyService->created($subscription);
            }

            return $subscription;
        });
    }


    // renew
    public function renew(
        TenantSubscription $subscription,
        array $data
    ): TenantSubscription {

        return DB::transaction(function () use ($subscription, $data) {

            $oldPlan = $subscription->subscription_plan_id;

            $startDate = Carbon::parse($data['start_date']);

            $endDate = $this->calculationService->calculateEndDate(
                $subscription->billing_cycle,
                $startDate
            );

            $finalAmount = $this->calculationService->calculateFinalAmount(

                $data['amount'],

                $data['discount'] ?? 0,

                $data['tax'] ?? 0

            );

            $subscription->update([

                'activated_at' => now(),

                'start_date' => $startDate,

                'end_date' => $endDate,

                'amount' => $data['amount'],

                'discount' => $data['discount'] ?? 0,

                'tax' => $data['tax'] ?? 0,

                'final_amount' => $finalAmount,

                'status' => 'active',

                'renewal_count' => $subscription->renewal_count + 1,

                'remarks' => $data['remarks'] ?? null,

            ]);

            $this->historyService->renewed(
                $subscription,
                $oldPlan
            );

            return $subscription->fresh();
        });
    }



    // upgrade
    public function upgrade(
        TenantSubscription $subscription,
        array $data
    ): TenantSubscription {

        return DB::transaction(function () use ($subscription, $data) {

            $oldPlan = $subscription->subscription_plan_id;

            $startDate = Carbon::parse($data['start_date']);

            $endDate = $this->calculationService->calculateEndDate(

                $data['billing_cycle'],

                $startDate

            );

            $finalAmount = $this->calculationService->calculateFinalAmount(

                $data['amount'],

                $data['discount'] ?? 0,

                $data['tax'] ?? 0

            );

            $subscription->update([

                'subscription_plan_id' => $data['subscription_plan_id'],

                'billing_cycle' => $data['billing_cycle'],

                'activated_at' => now(),

                'start_date' => $startDate,

                'end_date' => $endDate,

                'amount' => $data['amount'],

                'discount' => $data['discount'] ?? 0,

                'tax' => $data['tax'] ?? 0,

                'final_amount' => $finalAmount,

                'status' => 'active',

                'remarks' => $data['remarks'] ?? null,

            ]);

            $this->historyService->upgraded(

                $subscription,

                $oldPlan

            );

            return $subscription->fresh();
        });
    }




    // downgrade
    public function downgrade(
        TenantSubscription $subscription,
        array $data
    ): TenantSubscription {

        return DB::transaction(function () use ($subscription, $data) {

            $oldPlan = $subscription->subscription_plan_id;

            $startDate = Carbon::parse($data['start_date']);

            $endDate = $this->calculationService->calculateEndDate(
                $data['billing_cycle'],
                $startDate
            );

            $finalAmount = $this->calculationService->calculateFinalAmount(
                $data['amount'],
                $data['discount'] ?? 0,
                $data['tax'] ?? 0
            );

            $subscription->update([

                'subscription_plan_id' => $data['subscription_plan_id'],

                'billing_cycle' => $data['billing_cycle'],

                'activated_at' => now(),

                'start_date' => $startDate,

                'end_date' => $endDate,

                'amount' => $data['amount'],

                'discount' => $data['discount'] ?? 0,

                'tax' => $data['tax'] ?? 0,

                'final_amount' => $finalAmount,

                'status' => 'active',

                'remarks' => $data['remarks'] ?? null,

            ]);

            $this->historyService->downgraded(
                $subscription,
                $oldPlan
            );

            return $subscription->fresh();
        });
    }

    // cancel
    public function cancel(
        TenantSubscription $subscription,
        $remarks = null
    ): TenantSubscription {

        return DB::transaction(function () use ($subscription, $remarks) {

            $subscription->update([

                'status' => 'cancelled',

                'cancelled_at' => now(),

                'remarks' => $remarks,

            ]);

            $this->historyService->cancelled(
                $subscription,
                $remarks
            );

            return $subscription->fresh();
        });
    }

    // suspend
    public function suspend(
        TenantSubscription $subscription,
        $remarks = null
    ): TenantSubscription {

        return DB::transaction(function () use ($subscription, $remarks) {

            $subscription->update([

                'status' => 'suspended',

                'suspended_at' => now(),

                'remarks' => $remarks,

            ]);

            $this->historyService->suspended(
                $subscription,
                $remarks
            );

            return $subscription->fresh();
        });
    }

    // expire
    public function expire(
        TenantSubscription $subscription,
        $remarks = null
    ): TenantSubscription {

        return DB::transaction(function () use ($subscription, $remarks) {

            $subscription->update([

                'status' => 'expired',

                'expired_at' => now(),

                'remarks' => $remarks,

            ]);

            $this->historyService->expired(
                $subscription,
                $remarks
            );

            return $subscription->fresh();
        });
    }

    // reactivate
    public function reactivate(
        TenantSubscription $subscription,
        $remarks = null
    ): TenantSubscription {

        return DB::transaction(function () use ($subscription, $remarks) {

            $subscription->update([

                'status' => 'active',

                'activated_at' => now(),

                'cancelled_at' => null,

                'suspended_at' => null,

                'expired_at' => null,

                'remarks' => $remarks,

            ]);

            $this->historyService->reactivated(
                $subscription,
                $remarks
            );

            return $subscription->fresh();
        });
    }

    // convert trial
    public function convertTrial(
        TenantSubscription $subscription,
        array $data
    ): TenantSubscription {

        return DB::transaction(function () use ($subscription, $data) {

            $startDate = Carbon::parse($data['start_date']);

            $endDate = $this->calculationService->calculateEndDate(
                $data['billing_cycle'],
                $startDate
            );

            $finalAmount = $this->calculationService->calculateFinalAmount(
                $data['amount'],
                $data['discount'] ?? 0,
                $data['tax'] ?? 0
            );

            $subscription->update([

                'is_trial' => false,

                'trial_end_date' => now(),

                'subscription_plan_id' => $data['subscription_plan_id'],

                'billing_cycle' => $data['billing_cycle'],

                'activated_at' => now(),

                'start_date' => $startDate,

                'end_date' => $endDate,

                'amount' => $data['amount'],

                'discount' => $data['discount'] ?? 0,

                'tax' => $data['tax'] ?? 0,

                'final_amount' => $finalAmount,

                'status' => 'active',

                'remarks' => $data['remarks'] ?? null,

            ]);

            $this->historyService->trialConverted($subscription);

            return $subscription->fresh();
        });
    }

    // active subscription
    public function getActiveSubscription(int $tenantId): ?TenantSubscription
    {
        return TenantSubscription::where('tenant_id', $tenantId)
            ->where('status', 'active')
            ->first();
    }

    // active
    public function isActive(TenantSubscription $subscription): bool
    {
        return $subscription->status === 'active'
            && $subscription->end_date >= now()->toDateString();
    }

    // expired
    public function isExpired(TenantSubscription $subscription): bool
    {
        return now()->gt($subscription->end_date);
    }
}
