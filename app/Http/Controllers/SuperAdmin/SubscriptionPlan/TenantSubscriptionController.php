<?php

namespace App\Http\Controllers\SuperAdmin\SubscriptionPlan;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPlan;
use App\Models\SuperAdmin\SubscriptionPlan\TenantSubscription;
use App\Traits\CommonCrudOperations;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TenantSubscriptionController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend.SuperAdmin.Pages.SubscriptionPlan.tenant_subscription');
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            TenantSubscription::class,
            [
                'tenant',
                'subscriptionPlan'
            ]
        );
    }


    public function fetch()
    {
        return $this->commonFetch(
            TenantSubscription::class
        );
    }



    public function showWith(Request $request)
    {
        return $this->commonShow(
            TenantSubscription::class,
            $request,
            [
                'tenant',
                'subscriptionPlan'
            ]
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            TenantSubscription::class,
            $request
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            TenantSubscription::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            TenantSubscription::class,
            $request
        );
    }


    public function trash()
    {
        return $this->commonTrash(
            TenantSubscription::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            TenantSubscription::class,
            $request
        );
    }


    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            TenantSubscription::class,
            $request
        );
    }

    // activate
    public function activate(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->status == 'active') {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription is already active.'
            ]);
        }

        $subscription->update([
            'status'       => 'active',
            'activated_at' => now(),
            'suspended_at' => null,
            'cancelled_at' => null,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Subscription activated successfully.'
        ]);
    }

    // suspend
    public function suspend(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->status == 'suspended') {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription is already suspended.'
            ]);
        }

        $subscription->update([
            'status'       => 'suspended',
            'suspended_at' => now(),
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Subscription suspended successfully.'
        ]);
    }

    // resume
    public function resume(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->status != 'suspended') {
            return response()->json([
                'status'  => false,
                'message' => 'Only suspended subscriptions can be resumed.'
            ]);
        }

        $subscription->update([
            'status'       => 'active',
            'suspended_at' => null,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Subscription resumed successfully.'
        ]);
    }

    // cancel
    public function cancel(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->status == 'cancelled') {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription is already cancelled.'
            ]);
        }

        $subscription->update([
            'status'        => 'cancelled',
            'cancelled_at'  => now(),
            'auto_renew'    => false,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Subscription cancelled successfully.'
        ]);
    }

    // renew
    public function renew(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->status == 'cancelled') {
            return response()->json([
                'status'  => false,
                'message' => 'Cancelled subscription cannot be renewed.'
            ]);
        }

        switch ($subscription->billing_cycle) {

            case 'monthly':
                $endDate = now()->addMonth();
                break;

            case 'quarterly':
                $endDate = now()->addMonths(3);
                break;

            case 'half_yearly':
                $endDate = now()->addMonths(6);
                break;

            case 'yearly':
                $endDate = now()->addYear();
                break;

            default:
                $endDate = now();
                break;
        }

        $subscription->update([
            'status'          => 'active',
            'activated_at'    => now(),
            'expired_at'      => null,
            'cancelled_at'    => null,
            'suspended_at'    => null,
            'start_date'      => now()->toDateString(),
            'end_date'        => $endDate->toDateString(),
            'renewal_count'   => $subscription->renewal_count + 1,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Subscription renewed successfully.'
        ]);
    }

    // expire
    public function expire(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->status == 'expired') {
            return response()->json([
                'status'  => false,
                'message' => 'Subscription is already expired.'
            ]);
        }

        $subscription->update([
            'status'      => 'expired',
            'expired_at'  => now(),
            'auto_renew'  => false,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Subscription expired successfully.'
        ]);
    }

    // upgrade
    public function upgrade(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->subscription_plan_id == $request->subscription_plan_id) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription is already using this plan.'
            ]);
        }

        $subscription->update([
            'subscription_plan_id' => $request->subscription_plan_id,
            'activated_at'         => now(),
            'status'               => 'active',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subscription upgraded successfully.'
        ]);
    }

    // downgrade
    public function downgrade(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->subscription_plan_id == $request->subscription_plan_id) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription is already using this plan.'
            ]);
        }

        $subscription->update([
            'subscription_plan_id' => $request->subscription_plan_id,
            'activated_at'         => now(),
            'status'               => 'active',
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subscription downgraded successfully.'
        ]);
    }

    // change plan
    public function changePlan(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->subscription_plan_id == $request->subscription_plan_id) {
            return response()->json([
                'status' => false,
                'message' => 'Selected plan is already assigned.'
            ]);
        }

        $subscription->update([
            'subscription_plan_id' => $request->subscription_plan_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subscription plan changed successfully.'
        ]);
    }

    // start trial
    public function startTrial(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
            'trial_days' => 'nullable|integer|min:1',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if ($subscription->is_trial) {
            return response()->json([
                'status' => false,
                'message' => 'Trial already started.'
            ]);
        }

        $trialDays = $request->trial_days ?? 7;

        $subscription->update([
            'is_trial'         => true,
            'status'           => 'trial',
            'trial_start_date' => now()->toDateString(),
            'trial_end_date'   => now()->addDays($trialDays)->toDateString(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Trial started successfully.'
        ]);
    }

    // end trial
    public function endTrial(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription not found.'
            ]);
        }

        if (!$subscription->is_trial) {
            return response()->json([
                'status' => false,
                'message' => 'This subscription is not in trial.'
            ]);
        }

        $subscription->update([
            'is_trial'         => false,
            'status'           => 'active',
            'trial_end_date'   => now()->toDateString(),
            'activated_at'     => now(),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Trial ended successfully.'
        ]);
    }

    // toggle auto renew
    public function toggleAutoRenew(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tenant_subscriptions,id',
        ]);

        $subscription = TenantSubscription::find($request->id);

        if (!$subscription) {
            return response()->json([
                'status' => false,
                'message' => 'Subscription not found.'
            ]);
        }

        $subscription->update([
            'auto_renew' => !$subscription->auto_renew,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Auto renew updated successfully.',
            'auto_renew' => $subscription->fresh()->auto_renew,
        ]);
    }
    // subscription history
    public function history(TenantSubscription $tenantSubscription)
    {
        //
    }

    // invoices
    public function invoices(TenantSubscription $tenantSubscription)
    {
        //
    }

    // payments
    public function payments(TenantSubscription $tenantSubscription)
    {
        //
    }

    // addons
    public function addons(TenantSubscription $tenantSubscription)
    {
        //
    }

    // feature overrides
    public function featureOverrides(TenantSubscription $tenantSubscription)
    {
        //
    }

    // usage
    public function usage(TenantSubscription $tenantSubscription)
    {
        //
    }

    // status update
    public function updateStatus(Request $request, TenantSubscription $tenantSubscription)
    {
        //
    }

    // search
    public function search(Request $request)
    {
        //
    }

    // filter
    public function filter(Request $request)
    {
        //
    }

    public function getLeaseManagementData(Request $request)
    {
        $request->validate(['tenant_id' => 'required|integer']);

        $tenantId = $request->tenant_id;

        $activeSubscription = $this->commonGet(TenantSubscription::class, ['tenant', 'plan', 'histories'], ['tenant_id' => $tenantId, 'status' => 'active', 'deleted_at' => null], 'id', 'desc', null, null, 'first');

        $availablePlans = $this->commonGet(SubscriptionPlan::class, [], ['status' => true, 'deleted_at' => null], 'id', 'desc', null, null, 'collection');

        return response()->json([
            'success' => true,
            'activeSubscription' => $activeSubscription,
            'availablePlans' => $availablePlans
        ]);
    }

    // public function processLeaseChange(Request $request)
    // {
    //     $request->validate([
    //         'tenant_id' => 'required|integer',
    //         'subscription_plan_id' => 'required|integer',
    //         'billing_cycle' => 'required|in:monthly,quarterly,half_yearly,yearly',
    //         'action_intent' => 'required|in:renewed,upgraded,downgraded,created',
    //         'amount' => 'required|numeric|min:0',
    //         'discount' => 'required|numeric|min:0',
    //         'remarks' => 'required|string|max:1000'
    //     ]);

    //     DB::beginTransaction();
    //     try {
    //         $tenantId = $request->tenant_id;
    //         $planId = $request->subscription_plan_id;
    //         $cycle = $request->billing_cycle;
    //         $intent = $request->action_intent;
    //         $baseAmount = $request->amount;
    //         $discount = $request->discount;

    //         $taxRate = 0.18;
    //         $taxableAmount = $baseAmount - $discount;
    //         $calculatedTax = $taxableAmount * $taxRate;
    //         $finalAmount = $taxableAmount + $calculatedTax;

    //     $oldSubscription = $this->commonGet(TenantSubscription::class, [], ['tenant_id' => $tenantId, 'deleted_at' => null], 'id', 'desc', null, null, 'first');


    //         $oldPlanId = $oldSubscription ? $oldSubscription->subscription_plan_id : null;

    //         $startDate = Carbon::now();
    //         $endDate = match ($cycle) {
    //             'monthly' => Carbon::now()->addMonth(),
    //             'quarterly' => Carbon::now()->addMonths(3),
    //             'half_yearly' => Carbon::now()->addMonths(6),
    //             'yearly' => Carbon::now()->addYear(),
    //         };


    //         if ($oldSubscription) {
    //             DB::table('tenant_subscriptions')
    //                 ->where('id', $oldSubscription->id)
    //                 ->update([
    //                     'status' => 'expired',
    //                     'expired_at' => Carbon::now(),
    //                     'updated_at' => Carbon::now()
    //                 ]);
    //         }


    //         $newSubscriptionId = DB::table('tenant_subscriptions')->insertGetId([
    //             'tenant_id' => $tenantId,
    //             'subscription_plan_id' => $planId,
    //             'billing_cycle' => $cycle,
    //             'activated_at' => Carbon::now(),
    //             'start_date' => $startDate->toDateString(),
    //             'end_date' => $endDate->toDateString(),
    //             'amount' => $baseAmount,
    //             'discount' => $discount,
    //             'tax' => $calculatedTax,
    //             'final_amount' => $finalAmount,
    //             'status' => 'active',
    //             'remarks' => $request->remarks,
    //             'created_at' => Carbon::now(),
    //             'updated_at' => Carbon::now()
    //         ]);


    //         DB::table('subscription_histories')->insert([
    //             'tenant_subscription_id' => $newSubscriptionId,
    //             'tenant_id' => $tenantId,
    //             'old_plan_id' => $oldPlanId,
    //             'new_plan_id' => $planId,
    //             'action' => $intent,
    //             'amount' => $finalAmount,
    //             'remarks' => $request->remarks,
    //             'meta' => json_encode([
    //                 'computed_tax' => $calculatedTax,
    //                 'applied_discount' => $discount,
    //                 'execution_timestamp' => Carbon::now()->toIso8601String()
    //             ]),
    //             'created_by' => Auth::id() ?? 1,
    //             'created_at' => Carbon::now(),
    //             'updated_at' => Carbon::now()
    //         ]);

    //         DB::commit();
    //         return response()->json([
    //             'success' => true,
    //             'message' => "Lease matrix successfully executed! Action [" . strtoupper($intent) . "] has locked onto runtime pipelines."
    //         ]);
    //     } catch (Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Exception aborting lease migration matrix logs. Details: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }


    public function processLeaseChange(Request $request)
    {
        $request->validate([
            'tenant_id' => 'required|integer',
            'subscription_plan_id' => 'required|integer',
            'billing_cycle' => 'required|in:monthly,quarterly,half_yearly,yearly',
            'action_intent' => 'required|in:renewed,upgraded,downgraded,created',
            'amount' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'remarks' => 'required|string|max:1000'
        ]);

        DB::beginTransaction();
        try {
            $tenantId = $request->tenant_id;
            $planId = $request->subscription_plan_id;
            $cycle = $request->billing_cycle;
            $intent = $request->action_intent;
            $baseAmount = $request->amount;
            $discount = $request->discount;


            if ($discount > $baseAmount) {
                throw new \Exception('Discount cannot exceed the base amount.');
            }

            $taxRate = 0.18;
            $taxableAmount = $baseAmount - $discount;
            $calculatedTax = $taxableAmount * $taxRate;
            $finalAmount = $taxableAmount + $calculatedTax;


            $oldSubscription = DB::table('tenant_subscriptions')
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->whereNull('deleted_at')
                ->orderByDesc('id')
                ->lockForUpdate()
                ->first();

            $oldPlanId = $oldSubscription ? $oldSubscription->subscription_plan_id : null;

            $startDate = Carbon::now();
            $endDate = match ($cycle) {
                'monthly' => Carbon::now()->addMonth(),
                'quarterly' => Carbon::now()->addMonths(3),
                'half_yearly' => Carbon::now()->addMonths(6),
                'yearly' => Carbon::now()->addYear(),
            };

            if ($oldSubscription) {
                DB::table('tenant_subscriptions')
                    ->where('id', $oldSubscription->id)
                    ->update([
                        'status' => 'expired',
                        'expired_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
            }

            $newSubscriptionId = DB::table('tenant_subscriptions')->insertGetId([
                'tenant_id' => $tenantId,
                'subscription_plan_id' => $planId,
                'billing_cycle' => $cycle,
                'activated_at' => Carbon::now(),
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'amount' => $baseAmount,
                'discount' => $discount,
                'tax' => $calculatedTax,
                'final_amount' => $finalAmount,
                'status' => 'active',
                'remarks' => $request->remarks,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            DB::table('subscription_histories')->insert([
                'tenant_subscription_id' => $newSubscriptionId,
                'tenant_id' => $tenantId,
                'old_plan_id' => $oldPlanId,
                'new_plan_id' => $planId,
                'action' => $intent,
                'amount' => $finalAmount,
                'remarks' => $request->remarks,
                'meta' => json_encode([
                    'computed_tax' => $calculatedTax,
                    'applied_discount' => $discount,
                    'execution_timestamp' => Carbon::now()->toIso8601String()
                ]),
                'created_by' => Auth::id() ?? 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Lease matrix successfully executed! Action [" . strtoupper($intent) . "] has locked onto runtime pipelines."
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Exception aborting lease migration matrix logs. Details: ' . $e->getMessage()
            ], 500);
        }
    }
}
