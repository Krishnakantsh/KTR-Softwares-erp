<?php

namespace App\Http\Controllers\SuperAdmin\SubscriptionPlan;

use App\Http\Controllers\Controller;

use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPlan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Traits\CommonCrudOperations;

class SubscriptionPlanController extends Controller
{
    use CommonCrudOperations;



    public function store(Request $request)
    {
        $request->validate([

            'name'              => 'required|string|max:255',
            'code'              => 'required|string|max:255',
            'monthly_price'     => 'nullable|numeric|min:0',
            'quarterly_price'   => 'nullable|numeric|min:0',
            'half_yearly_price' => 'nullable|numeric|min:0',
            'yearly_price'      => 'nullable|numeric|min:0',
            'trial_days'        => 'nullable|integer|min:0',
            'max_students'      => 'nullable|integer|min:0',
            'max_users'         => 'nullable|integer|min:0',
            'max_branches'      => 'nullable|integer|min:0',

        ]);

        DB::beginTransaction();

        try {

            $data = [

                'name'              => $request->name,
                'code'              => strtoupper($request->code),
                'description'       => $request->description,

                'monthly_price'     => $request->monthly_price ?? 0,
                'quarterly_price'   => $request->quarterly_price ?? 0,
                'half_yearly_price' => $request->half_yearly_price ?? 0,
                'yearly_price'      => $request->yearly_price ?? 0,

                'trial_days'        => $request->trial_days ?? 0,

                'max_students'      => $request->max_students,
                'max_users'         => $request->max_users,
                'max_branches'      => $request->max_branches,

                'is_custom'         => (bool) $request->is_custom,
                'sort_order'        => $request->sort_order ?? 0,
                'status'            => (bool) $request->status,
            ];

            SubscriptionPlan::updateOrCreate(

                ['id' => $request->id],

                $data

            );

            DB::commit();

            return response()->json([

                'status'  => true,

                'message' => $request->filled('id')
                    ? 'Subscription Plan updated successfully'
                    : 'Subscription Plan added successfully'

            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([

                'status'  => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }

    // fetch

    public function fetch()
    {
        return $this->commonFetch(
            SubscriptionPlan::class
        );
    }

    // show

    public function show(Request $request)
    {
        return $this->commonGet(
            SubscriptionPlan::class,
            [],
            ['id' => $request->id]
        );
    }

    // status

    public function status(Request $request)
    {
        return $this->toggleStatus(
            SubscriptionPlan::class,
            $request
        );
    }

    // delete

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            SubscriptionPlan::class,
            $request
        );
    }

    // trash

    public function trash()
    {
        return $this->commonTrash(
            SubscriptionPlan::class
        );
    }

    // restore

    public function restore(Request $request)
    {
        return $this->commonRestore(
            SubscriptionPlan::class,
            $request
        );
    }

    // force delete

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            SubscriptionPlan::class,
            $request
        );
    }
}
