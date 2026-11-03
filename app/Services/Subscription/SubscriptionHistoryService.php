<?php

namespace App\Services\Subscription;

use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionHistory;
use Illuminate\Support\Facades\Auth;

// use App\Models\SubscriptionHistory;

class SubscriptionHistoryService
{
    // create
    public function create(array $data): SubscriptionHistory
    {
        return SubscriptionHistory::create([

            'tenant_subscription_id' => $data['tenant_subscription_id'],

            'tenant_id' => $data['tenant_id'],

            'old_plan_id' => $data['old_plan_id'] ?? null,

            'new_plan_id' => $data['new_plan_id'] ?? null,

            'action' => $data['action'],

            'amount' => $data['amount'] ?? 0,

            'meta' => $data['meta'] ?? null,

            'remarks' => $data['remarks'] ?? null,

            'created_by' => $data['created_by'] ?? Auth::id(),

        ]);
    }

    // created
    public function created($subscription, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'created',

            'amount' => $subscription->final_amount,

            'remarks' => $remarks,

        ]);
    }

    // trial started
    public function trialStarted($subscription, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'trial_started',

            'amount' => 0,

            'remarks' => $remarks,

        ]);
    }

    // trial converted
    public function trialConverted($subscription, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'trial_converted',

            'amount' => $subscription->final_amount,

            'remarks' => $remarks,

        ]);
    }

    // renewed
    public function renewed($subscription, $oldPlanId, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'old_plan_id' => $oldPlanId,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'renewed',

            'amount' => $subscription->final_amount,

            'remarks' => $remarks,

        ]);
    }

    // upgraded
    public function upgraded($subscription, $oldPlanId, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'old_plan_id' => $oldPlanId,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'upgraded',

            'amount' => $subscription->final_amount,

            'remarks' => $remarks,

        ]);
    }

    // downgraded
    public function downgraded($subscription, $oldPlanId, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'old_plan_id' => $oldPlanId,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'downgraded',

            'amount' => $subscription->final_amount,

            'remarks' => $remarks,

        ]);
    }

    // cancelled
    public function cancelled($subscription, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'old_plan_id' => $subscription->subscription_plan_id,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'cancelled',

            'amount' => $subscription->final_amount,

            'remarks' => $remarks,

        ]);
    }

    // suspended
    public function suspended($subscription, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'old_plan_id' => $subscription->subscription_plan_id,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'suspended',

            'amount' => $subscription->final_amount,

            'remarks' => $remarks,

        ]);
    }

    // expired
    public function expired($subscription, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'old_plan_id' => $subscription->subscription_plan_id,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'expired',

            'amount' => $subscription->final_amount,

            'remarks' => $remarks,

        ]);
    }

    // reactivated
    public function reactivated($subscription, $remarks = null): SubscriptionHistory
    {
        return $this->create([

            'tenant_subscription_id' => $subscription->id,

            'tenant_id' => $subscription->tenant_id,

            'old_plan_id' => $subscription->subscription_plan_id,

            'new_plan_id' => $subscription->subscription_plan_id,

            'action' => 'reactivated',

            'amount' => $subscription->final_amount,

            'remarks' => $remarks,

        ]);
    }
}
