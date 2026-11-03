<?php

namespace App\Http\Controllers\Complaints;

use App\Http\Controllers\Controller;
use App\Models\Complaints\Complaint;
use App\Models\Complaints\ComplaintMessage;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComplaintMessageController extends Controller
{
    use CommonCrudOperations;

    public function fetch(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
        ]);

        $messages = ComplaintMessage::where('complaint_id', $request->complaint_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json([
            'status' => true,
            'data'   => $messages,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'complaint_id' => 'required|exists:complaints,id',
            'message'      => 'required|string',
            'message_type' => 'nullable|in:1,2,3', // 1=Comment,2=Feedback,3=Internal Note
        ]);

        DB::beginTransaction();

        try {

            $complaintMessage = new ComplaintMessage();

            $complaintMessage->complaint_id = $request->complaint_id;
            $complaintMessage->message_type = $request->message_type ?? 1;
            $complaintMessage->message      = $request->message;

            /*
            |--------------------------------------------------------------------------
            | Sender (Created By)
            |--------------------------------------------------------------------------
            |
            | 1 = Admin
            | 2 = Staff
            | 3 = Student
            |
            | Abhi ye admin dashboard se hi chal raha hai, isliye default 1 (Admin)
            | rakha hai — jaise ComplaintController@store me raised_by_type/id
            | ka default pattern hai. Agar future me staff/student panel se bhi
            | isi controller ko use karna ho, to request se type/id lena
            | aur auth guard ke hisaab se override karna.
            |--------------------------------------------------------------------------
            */

            $complaintMessage->created_by_type = $request->created_by_type ?? 1;
            $complaintMessage->created_by_id   = $request->created_by_id ?? (auth()->id() ?? 1);

            $complaintMessage->status = true;

            $complaintMessage->save();

            /*
            |--------------------------------------------------------------------------
            | Optional: Complaint status ko "In Progress" me move kar do
            | agar wo abhi "Open" hai aur Admin ne reply kiya hai.
            |--------------------------------------------------------------------------
            */

            // $complaint = Complaint::find($request->complaint_id);

            // if ($complaint && $complaint->status == 1 && $complaintMessage->created_by_type == 1) {
            //     $complaint->status = 2; // In Progress
            //     $complaint->save();
            // }

            $complaint = Complaint::find($request->complaint_id);

            if ($complaint) {

                // Open complaint par Admin ka pehla reply -> In Progress
                if ($complaint->status == 1 && $complaintMessage->created_by_type == 1) {
                    $complaint->status = 3;
                    $complaint->save();
                }

                // Resolved/Closed/Rejected complaint par Staff/Student dobara message bheje -> Reopened
                elseif (in_array($complaint->status, [4, 5, 7]) && $complaintMessage->created_by_type != 1) {
                    $complaint->status       = 6;
                    $complaint->resolved_at  = null;
                    $complaint->closed_at    = null;
                    $complaint->save();
                }
            }

            DB::commit();

            return response()->json([
                'status'            => true,
                'message'           => 'Message sent successfully.',
                'data'              => $complaintMessage,
                'complaint_status'  => $complaint->status,
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            ComplaintMessage::class,
            $request
        );
    }

    public function update(Request $request)
    {
        $request->validate([
            'id'      => 'required|exists:complaint_messages,id',
            'message' => 'required|string',
        ]);

        DB::beginTransaction();

        try {

            $complaintMessage = ComplaintMessage::findOrFail($request->id);
            $complaintMessage->message = $request->message;
            $complaintMessage->save();

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Message updated successfully.',
                'data'    => $complaintMessage,
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function status(Request $request)
    {
        return $this->toggleStatus(
            ComplaintMessage::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            ComplaintMessage::class,
            $request
        );
    }
}
