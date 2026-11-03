<?php

namespace App\Http\Controllers\FeeModule;

use App\Http\Controllers\Controller;
use App\Models\FeeModule\FeeHead;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeeHeadController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {

        return view('School.Pages.FeeModule.feeHeads');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'            => 'nullable|exists:fee_heads,id',
            'fee_group_id'  => 'required|exists:fee_groups,id',
            'head_name'     => 'required|string|max:100',
            'head_code'     => 'nullable|string|max:30',
            'display_order' => 'nullable|integer',
            'description'   => 'nullable|string',
            'status'        => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $feeHead = $request->filled('id')
                ? FeeHead::findOrFail($request->id)
                : new FeeHead();

            $feeHead->school_id      = null;
            $feeHead->fee_group_id   = $request->fee_group_id;
            $feeHead->head_name      = $request->head_name;
            $feeHead->head_code      = $request->head_code;
            $feeHead->display_order  = $request->display_order ?? 0;
            $feeHead->description    = $request->description;
            $feeHead->status         = $request->has('status') ? (bool) $request->status : false;

            $feeHead->save();

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $feeHead->wasRecentlyCreated
                    ? 'Fee head added successfully.'
                    : 'Fee head updated successfully.',
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
            FeeHead::class,
            ['group']
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            FeeHead::class,
            ['group']
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            FeeHead::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            FeeHead::class,
            $request,
            ['group']
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            FeeHead::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            FeeHead::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            FeeHead::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            FeeHead::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            FeeHead::class,
            $request
        );
    }
}
