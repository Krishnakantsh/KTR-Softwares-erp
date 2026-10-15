<?php

namespace App\Http\Controllers\SuperAdmin\SubscriptionPlan;

use App\Http\Controllers\Controller;
use App\Models\SuperAdmin\SubscriptionPlan\PlanFeature;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Traits\CommonCrudOperations;

class PlanFeatureController extends Controller
{
    use CommonCrudOperations;

    // store

    public function store(Request $request)
    {
        $request->validate([

            'name'        => 'required|string|max:255',
            'slug'        => 'required|string|max:255',
            'module_name' => 'nullable|string|max:255',

        ]);

        DB::beginTransaction();

        try {

            $data = [

                'name'        => $request->name,
                'slug'        => strtolower($request->slug),
                'module_name' => $request->module_name,
                'description' => $request->description,
                'status'      => (bool) $request->status,

            ];

            PlanFeature::updateOrCreate(

                ['id' => $request->id],

                $data

            );

            DB::commit();

            return response()->json([

                'status'  => true,

                'message' => $request->filled('id')
                    ? 'Plan Feature updated successfully'
                    : 'Plan Feature added successfully'

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
            PlanFeature::class
        );
    }

    // show

    public function show(Request $request)
    {
        return $this->commonGet(
            PlanFeature::class,
            [],
            ['id' => $request->id]
        );
    }

    // status

    public function status(Request $request)
    {
        return $this->toggleStatus(
            PlanFeature::class,
            $request
        );
    }

    // delete

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            PlanFeature::class,
            $request
        );
    }

    // trash

    public function trash()
    {
        return $this->commonTrash(
            PlanFeature::class
        );
    }

    // restore

    public function restore(Request $request)
    {
        return $this->commonRestore(
            PlanFeature::class,
            $request
        );
    }

    // force delete

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            PlanFeature::class,
            $request
        );
    }
}
