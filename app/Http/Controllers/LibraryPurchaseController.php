<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibraryPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonCrudOperations;

class LibraryPurchaseController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend.Normal.Pages.Library.purchase');
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id'     => 'required|integer',
            'invoice_no'      => 'required|string|max:255',
            'invoice_date'    => 'required|date',

            'sub_total'       => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'gst_amount'      => 'nullable|numeric|min:0',
            'grand_total'     => 'required|numeric|min:0',

            'status'          => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'school_id' => null,
                'session_id' => activeSession()->id,

                'supplier_id' => $request->supplier_id,

                'invoice_no' => $request->invoice_no,
                'invoice_date' => $request->invoice_date,

                'sub_total' => $request->sub_total,
                'discount_amount' => $request->discount_amount ?? 0,
                'gst_amount' => $request->gst_amount ?? 0,
                'grand_total' => $request->grand_total,

                'remarks' => $request->remarks,

                'status' => (int) $request->status,

                'updated_by' => Auth::id(),
            ];

            if ($request->filled('id')) {

                LibraryPurchase::where('id', $request->id)
                    ->update($data);
            } else {

                $data['created_by'] = Auth::id();

                LibraryPurchase::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('id')
                    ? 'Purchase updated successfully'
                    : 'Purchase added successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            LibraryPurchase::class
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryPurchase::class,
            $request
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            LibraryPurchase::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryPurchase::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            LibraryPurchase::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryPurchase::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryPurchase::class,
            $request
        );
    }
}
