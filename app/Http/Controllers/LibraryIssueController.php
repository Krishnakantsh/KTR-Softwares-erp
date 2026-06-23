<?php

namespace App\Http\Controllers;

use App\Models\LibraryBook;
use App\Models\LibraryBookRenewHistory;
use Exception;
use App\Models\LibraryIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonCrudOperations;

class LibraryIssueController extends Controller
{
    use CommonCrudOperations;



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

                'school_id'         => null,
                'session_id'        => activeSession()->id,
                'book_id'           => $request->book_id,
                'member_type'       => $request->member_type,
                'member_id'         => $request->member_id,
                'issue_date'        => $request->issue_date,
                'due_date'          => $request->due_date,
                'return_date'       => $request->return_date,
                'issue_days'        => $request->issue_days ?? 0,
                'fine_amount'       => $request->fine_amount ?? 0,
                'gst_amount'        => $request->gst_amount ?? 0,
                'total_fine_amount' => $request->total_fine_amount ?? 0,
                'status'            => $request->status,
                'remarks'           => $request->remarks,
                'updated_by'        => Auth::id(),
            ];

            if ($request->filled('id')) {

                $issue = LibraryIssue::findOrFail($request->id);

                $oldBookId = $issue->book_id;

                $issue->update($data);

                // old book recalculate
                $this->updateBookStock($oldBookId);

                // new book recalculate
                if ($oldBookId != $request->book_id) {
                    $this->updateBookStock($request->book_id);
                }
            } else {

                $data['created_by'] = Auth::id();

                LibraryIssue::create($data);

                $this->updateBookStock($request->book_id);
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('id')
                    ? 'Book issue updated successfully'
                    : 'Book issued successfully'
            ]);
        } catch (\Exception $e) {

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


    private function updateBookStock($bookId)
    {
        $book = LibraryBook::findOrFail($bookId);

        $issued = LibraryIssue::where('book_id', $bookId)
            ->where('status', 'issued')
            ->count();

        $returned = LibraryIssue::where('book_id', $bookId)
            ->where('status', 'returned')
            ->count();

        $lost = LibraryIssue::where('book_id', $bookId)
            ->where('status', 'lost')
            ->count();

        $damaged = LibraryIssue::where('book_id', $bookId)
            ->where('status', 'damaged')
            ->count();

        $available = $book->quantity - ($issued + $lost + $damaged);

        $book->update([

            'issued_quantity'    => $issued,
            'lost_quantity'      => $lost,
            'damaged_quantity'   => $damaged,
            'available_quantity' => max(0, $available),

        ]);
    }


    public function destroy($id)
    {
        DB::beginTransaction();

        try {

            $issue = LibraryIssue::findOrFail($id);

            $bookId = $issue->book_id;

            $issue->delete();

            $this->updateBookStock($bookId);

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Deleted successfully'
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    public function returnBook(Request $request)
    {
        try {

            $bookIssueRecord = LibraryIssue::where('id', $request->history_id)
                ->where('member_id', $request->member_id)
                ->firstOrFail();

            $fine_amount = $request->fine_amount ?? 0;

            $bookIssueRecord->fine_amount = $fine_amount;

            $bookIssueRecord->total_fine_amount += $fine_amount;

            $bookIssueRecord->return_date = $request->action_date;

            $bookIssueRecord->remarks = $request->remark;

            $bookIssueRecord->status = 'returned';

            $bookIssueRecord->save();

            return response()->json([
                'success' => true,
                'message' => 'Book returned successfully'
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }


    // Renew Request Process
    // public function renewBook(Request $request)
    // {
    //     try {

    //         // fetch
    //         $bookIssueRecord = LibraryBook::where('id', $request->history_id)
    //             ->where('member_id', $request->member_id)
    //             ->firstOrFail();

    //         // update
    //         $bookIssueRecord->due_date = $request->action_date;
    //         $bookIssueRecord->remarks = $request->remark;
    //         $bookIssueRecord->status = 'issued';

    //         $bookIssueRecord->save();

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Book renewed successfully.'
    //         ]);
    //     } catch (\Throwable $th) {

    //         return response()->json([
    //             'status' => false,
    //             'message' => $th->getMessage() ?: 'Something went wrong.'
    //         ]);
    //     }
    // }

    public function renewBook(Request $request)
    {
        try {

            // fetch
            $bookIssueRecord = LibraryIssue::where('id', $request->history_id)
                ->where('member_id', $request->member_id)
                ->firstOrFail();

            // create renew history
            LibraryBookRenewHistory::create([

                'library_book_id' => $bookIssueRecord->id,

                'old_due_date' => $bookIssueRecord->due_date,

                'new_due_date' => $request->action_date,

                'remarks' => $request->remark,

                'renewed_by' => Auth::id(),

            ]);

            // update current record
            $bookIssueRecord->due_date = $request->action_date;
            $bookIssueRecord->remarks = $request->remark;

            $bookIssueRecord->save();

            return response()->json([
                'success' => true,
                'message' => 'Book renewed successfully'
            ]);
        } catch (\Throwable $th) {

            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
