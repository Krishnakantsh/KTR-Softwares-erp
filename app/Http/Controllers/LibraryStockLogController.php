<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibraryStockLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonCrudOperations;

class LibraryStockLogController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend.Normal.Pages.Library.stock_log');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id'           => 'required|integer',
            'transaction_type'  => 'required|in:purchase,issue,return,damage,lost,manual',

            'quantity'          => 'required|integer|min:1',

            'opening_stock'     => 'required|integer|min:0',
            'closing_stock'     => 'required|integer|min:0',

            'reference_type'    => 'required|string|max:255',
            'reference_id'      => 'required|integer',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'school_id' => null,
                'session_id' => activeSession()->id,

                'book_id' => $request->book_id,

                'transaction_type' => $request->transaction_type,

                'quantity' => $request->quantity,

                'opening_stock' => $request->opening_stock,
                'closing_stock' => $request->closing_stock,

                'reference_type' => $request->reference_type,
                'reference_id' => $request->reference_id,

                'remarks' => $request->remarks,

                'created_by' => Auth::id(),
            ];

            if ($request->filled('id')) {

                LibraryStockLog::where('id', $request->id)
                    ->update($data);
            } else {

                LibraryStockLog::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('id')
                    ? 'Stock log updated successfully'
                    : 'Stock log added successfully'
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
            LibraryStockLog::class
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryStockLog::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryStockLog::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            LibraryStockLog::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryStockLog::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryStockLog::class,
            $request
        );
    }
}