<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibraryFine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonCrudOperations;

class LibraryFineController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend.Normal.Pages.Library.fine');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fine_amount'     => 'required|numeric|min:0',
            'fine_duration'   => 'required|integer|min:1',
            'duration_type'   => 'required|in:day,week,month',
            'gst_percentage'  => 'nullable|numeric|min:0',
            'status'          => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'school_id'      => null,
                'session_id'     => activeSession()->id,

                'fine_amount'    => $request->fine_amount,
                'fine_duration'  => $request->fine_duration,
                'duration_type'  => $request->duration_type,
                'gst_percentage' => $request->gst_percentage ?? 0,
                'remarks'        => $request->remarks,

                'status'         => (int) $request->status,

                'updated_by'     => Auth::id(),
            ];

            if ($request->filled('id')) {

                LibraryFine::where('id', $request->id)
                    ->update($data);
            } else {

                $data['created_by'] = Auth::id();

                LibraryFine::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('id')
                    ? 'Fine updated successfully'
                    : 'Fine added successfully'
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
            LibraryFine::class
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryFine::class,
            $request
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            LibraryFine::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryFine::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            LibraryFine::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryFine::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryFine::class,
            $request
        );
    }
}
