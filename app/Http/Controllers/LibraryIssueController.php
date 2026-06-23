<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\LibraryIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonCrudOperations;

class LibraryIssueController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend.Normal.Pages.Library.issue');
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id'           => 'required|integer',
            'member_type'       => 'required|in:student,staff',
            'member_id'         => 'required|integer',

            'issue_date'        => 'required|date',
            'due_date'          => 'required|date',

            'return_date'       => 'nullable|date',

            'issue_days'        => 'nullable|integer|min:0',

            'fine_amount'       => 'nullable|numeric|min:0',
            'gst_amount'        => 'nullable|numeric|min:0',
            'total_fine_amount' => 'nullable|numeric|min:0',

            'status'            => 'required|in:issued,returned,lost,damaged',
        ]);

        DB::beginTransaction();

        try {

            $data = [

                'school_id' => null,
                'session_id' => activeSession()->id,

                'book_id' => $request->book_id,

                'member_type' => $request->member_type,
                'member_id' => $request->member_id,

                'issue_date' => $request->issue_date,
                'due_date' => $request->due_date,
                'return_date' => $request->return_date,

                'issue_days' => $request->issue_days ?? 0,

                'fine_amount' => $request->fine_amount ?? 0,
                'gst_amount' => $request->gst_amount ?? 0,
                'total_fine_amount' => $request->total_fine_amount ?? 0,

                'status' => $request->status,

                'remarks' => $request->remarks,

                'updated_by' => Auth::id(),
            ];

            if ($request->filled('id')) {

                LibraryIssue::where('id', $request->id)
                    ->update($data);
            } else {

                $data['created_by'] = Auth::id();

                LibraryIssue::create($data);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('id')
                    ? 'Book issue updated successfully'
                    : 'Book issued successfully'
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
            LibraryIssue::class
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            LibraryIssue::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            LibraryIssue::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            LibraryIssue::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            LibraryIssue::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            LibraryIssue::class,
            $request
        );
    }
}