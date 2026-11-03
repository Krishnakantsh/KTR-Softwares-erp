<?php

namespace App\Http\Controllers\Complaints;

use App\Http\Controllers\Controller;
use App\Models\Complaints\Complaint;
use App\Models\Student\Student;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ComplaintController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('School.Pages.Complaints.complaints');
    }

    public function dashboard()
    {
        return view('School.Pages.Complaints.dashboard');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id'                 => 'nullable|exists:complaints,id',

            'complaint_type_id'  => 'required|exists:complaint_types,id',

            'subject'            => 'required|string|max:255',

            'description'        => 'required|string',

            'priority'           => 'required|in:1,2,3,4',

            'status'             => 'nullable|boolean',
        ]);

        DB::beginTransaction();

        try {

            $complaint = $request->filled('id')
                ? Complaint::findOrFail($request->id)
                : new Complaint();

            /*
            |--------------------------------------------------------------------------
            | New Complaint Number
            |--------------------------------------------------------------------------
            */

            if (!$request->filled('id')) {

                $lastId = Complaint::withTrashed()->max('id') + 1;

                $complaint->complaint_no = 'CMP-' . date('Y') . '-' . str_pad($lastId, 5, '0', STR_PAD_LEFT);
            }

            /*
            |--------------------------------------------------------------------------
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $complaint->school_id = null;
            $complaint->session_id = session('session_id');
            $complaint->complaint_type_id = $request->complaint_type_id;
            $complaint->subject = $request->subject;
            $complaint->description = $request->description;
            $complaint->priority = $request->priority;
            $complaint->session_id = activeSession()->id;

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $complaint->status = 1; // Open

            $complaint->status_flag = $request->has('status')
                ? (bool)$request->status
                : false;

            /*
            |--------------------------------------------------------------------------
            | Raised By
            |--------------------------------------------------------------------------
            */

            $complaint->raised_by_type = $request->raised_by_type ?? 1;
            $complaint->raised_by_id   = $request->raised_by_id ?? 1;

            /*
            |--------------------------------------------------------------------------
            | Complaint Against
            |--------------------------------------------------------------------------
            | Student complaint by default against Admin
            | Later can be changed according to your flow.
            |--------------------------------------------------------------------------
            */

            $complaint->against_type =  $request->against_type ?? 1;
            $complaint->against_id   =  $request->against_id ?? 1;

            /*
            |--------------------------------------------------------------------------
            | Save
            |--------------------------------------------------------------------------
            */

            $complaint->save();

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $complaint->wasRecentlyCreated
                    ? 'Complaint registered successfully.'
                    : 'Complaint updated successfully.',
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
            Complaint::class,
            [
                'complaintType'
            ]
        );
    }

    public function fetchWith()
    {

        $complaints = Complaint::with(['complaintType', 'messages'])->latest()->get();

        /*
        |--------------------------------------------------------------------------
        | Prepare IDs
        |--------------------------------------------------------------------------
        */

        $studentIds = [];
        $staffIds = [];

        foreach ($complaints as $complaint) {

            if ($complaint->raised_by_type == 3) {
                $studentIds[] = $complaint->raised_by_id;
            } elseif ($complaint->raised_by_type == 2) {
                $staffIds[] = $complaint->raised_by_id;
            } elseif ($complaint->raised_by_type == 1) {

                if ($complaint->against_type == 3) {
                    $studentIds[] = $complaint->against_id;
                } elseif ($complaint->against_type == 2) {
                    $staffIds[] = $complaint->against_id;
                }
            }
        }

        $studentIds = array_unique($studentIds);
        $staffIds   = array_unique($staffIds);

        /*
        |--------------------------------------------------------------------------
        | Fetch Once
        |--------------------------------------------------------------------------
        */

        $students = Student::with(['classMaster', 'section'])->whereIn('id', $studentIds)
            ->get()
            ->keyBy('id');



        // $staffs = Staff::whereIn('id', $staffIds)
        //     ->get()
        //     ->keyBy('id');

        /*
        |--------------------------------------------------------------------------
        | Attach Details
        |--------------------------------------------------------------------------
        */

        foreach ($complaints as $complaint) {

            $complaint->person_details = null;

            if ($complaint->raised_by_type == 3) {
                $complaint->person_details = $students[$complaint->raised_by_id] ?? null;
            } elseif ($complaint->raised_by_type == 2) {
                // $complaint->person_details = $staffs[$complaint->raised_by_id] ?? null;
            } elseif ($complaint->raised_by_type == 1) {

                if ($complaint->against_type == 3) {
                    $complaint->person_details = $students[$complaint->against_id] ?? null;
                } elseif ($complaint->against_type == 2) {
                    // $complaint->person_details = $staffs[$complaint->against_id] ?? null;
                }
            }
        }

        return response()->json([
            'status' => true,
            'data' => $complaints,
        ]);
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            Complaint::class,
            $request,
            [
                'complaintType'
            ]
        );
    }

    public function showWith(Request $request)
    {
        $complaint = $this->commonShow(
            Complaint::class,
            $request,
            [
                'complaintType',
                'messages'
            ]
        );

        // Agar commonShow JSON Response return karta hai
        $data = $complaint->getData();

        if (!$data->status || empty($data->data)) {
            return $complaint;
        }

        $item = $data->data;

        $item->person_details = null;

        if ($item->raised_by_type == 3) {
            $item->person_details = Student::with(['classMaster', 'section'])->find($item->raised_by_id);
        } elseif ($item->raised_by_type == 2) {
            // $item->person_details = Staff::find($item->raised_by_id);
        } elseif ($item->raised_by_type == 1) {

            if ($item->against_type == 3) {
                $item->person_details = Student::with(['classMaster', 'section'])->find($item->against_id);
            } elseif ($item->against_type == 2) {
                // $item->person_details = Staff::find($item->against_id);
            }
        }

        return response()->json($data);
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            Complaint::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            Complaint::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            Complaint::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            Complaint::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            Complaint::class,
            $request
        );
    }







    /*
|--------------------------------------------------------------------------
| Status Management (Single Generic Method)
|--------------------------------------------------------------------------
|
| action values:
| resolve   -> status 4 (Resolved)
| close     -> status 5 (Closed)
| reopen    -> status 6 (Reopened)
| reject    -> status 7 (Rejected)
| escalate  -> priority ++ , status -> 3 (In Progress) agar Open/Under Review ho
|
*/

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id'     => 'required|exists:complaints,id',
            'action' => 'required|in:resolve,close,reopen,reject,escalate',
        ]);

        DB::beginTransaction();

        $message = '';

        try {
            $complaint = Complaint::findOrFail($request->id);

            switch ($request->action) {

                case 'resolve':
                    $complaint->status            = 4; // Resolved
                    $complaint->resolved_by_type  = $request->resolved_by_type ?? 1;
                    $complaint->resolved_by_id    = $request->resolved_by_id ?? (auth()->id() ?? 1);
                    $complaint->resolved_at       = now();
                    $message = 'Complaint marked as resolved.';
                    break;

                case 'close':
                    $complaint->status          = 5; // Closed
                    $complaint->closed_by_type  = $request->closed_by_type ?? 1;
                    $complaint->closed_by_id    = $request->closed_by_id ?? (auth()->id() ?? 1);
                    $complaint->closed_at       = now();
                    $message = 'Complaint closed successfully.';
                    break;

                case 'reopen':
                    $complaint->status           = 6; // Reopened
                    $complaint->resolved_by_type = null;
                    $complaint->resolved_by_id   = null;
                    $complaint->resolved_at      = null;
                    $complaint->closed_by_type   = null;
                    $complaint->closed_by_id     = null;
                    $complaint->closed_at        = null;
                    $message = 'Complaint reopened successfully.';
                    break;

                case 'reject':
                    $complaint->status           = 7; // Rejected
                    $complaint->resolved_by_type = $request->resolved_by_type ?? 1;
                    $complaint->resolved_by_id   = $request->resolved_by_id ?? (auth()->id() ?? 1);
                    $complaint->resolved_at      = now();
                    $message = 'Complaint rejected.';
                    break;

                case 'escalate':
                    if ($complaint->priority < 4) {
                        $complaint->priority += 1;
                    }
                    if (in_array($complaint->status, [1, 2])) {
                        $complaint->status = 3; // In Progress
                    }
                    $message = 'Complaint escalated.';
                    break;
            }

            $complaint->save();

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => $message,
                'data'    => $complaint,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
