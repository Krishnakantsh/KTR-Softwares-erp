<?php

namespace App\Http\Controllers\FeeModule;

use App\Http\Controllers\Controller;
use App\Models\FeeModule\FeeGroup;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeGroupController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('School.Pages.FeeModule.feeGroups');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id'          => 'nullable|exists:fee_groups,id',
            'group_name'  => 'required|string|max:100',
            'group_code'  => 'nullable|string|max:30',
            'description' => 'nullable|string',
            'status'      => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $feeGroup = $request->filled('id')
                ? FeeGroup::findOrFail($request->id)
                : new FeeGroup();

            $feeGroup->school_id   = null;
            $feeGroup->group_name  = $request->group_name;
            $feeGroup->group_code  = $request->group_code;
            $feeGroup->description = $request->description;
            $feeGroup->status      = $request->has('status') ? (bool) $request->status : false;

            $feeGroup->save();

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $feeGroup->wasRecentlyCreated
                    ? 'Fee group added successfully.'
                    : 'Fee group updated successfully.',
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            FeeGroup::class,
            []
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            FeeGroup::class,
            []
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            FeeGroup::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            FeeGroup::class,
            $request,
            []
        );
    }


    public function status(Request $request)
    {
        return $this->toggleStatus(
            FeeGroup::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            FeeGroup::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            FeeGroup::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            FeeGroup::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            FeeGroup::class,
            $request
        );
    }
}
