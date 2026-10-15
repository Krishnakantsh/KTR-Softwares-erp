<?php

namespace App\Http\Controllers\SuperAdmin\SubscriptionPlan;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\SubscriptionPlan\PlanFeature;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPlan;
use App\Traits\CommonCrudOperations;
use Illuminate\Http\Request;
use Throwable;

class PlanFeatureMappingController extends Controller
{

    use CommonCrudOperations;

    public function fetch(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required|exists:subscription_plans,id'
            ]);
            $allFeatures = $this->commonFetch(
                PlanFeature::class,
                [],
                [],
                'created_at',
                'desc',
                null,
                null,
                'collection'
            );

            $plan = SubscriptionPlan::with('features')
                ->findOrFail($request->id);

            $connectedFeatureIds = $plan->features->pluck('id')->toArray();

            return response()->json([
                'status' => true,
                'message' => 'Details fetched successfully.',
                'allFeatures' => $allFeatures,
                'connectedFeatureIds' => $connectedFeatureIds
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage() ?? 'Something went wrong !!! ',

            ]);
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'subscription_plan_id' => 'required|exists:subscription_plans,id',
                'plan_features' => 'nullable|array',
                'plan_features.*' => 'exists:plan_features,id'
            ]);

            $plan = SubscriptionPlan::findOrFail($request->subscription_plan_id);

            $plan->features()->sync($request->plan_features ?? []);

            return response()->json([
                'status' => true,
                'message' => 'Plan features mapped successfully.'
            ]);
        } catch (Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }



}
