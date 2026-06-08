<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\OnlineClass;
use App\Traits\CommonCrudOperations;

class OnlineClassController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend/Normal/Pages/Student/online-classes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id'      => 'required|exists:class_masters,id',
            'section_id'    => 'required|exists:class_sections,id',
            'stream_id'    => 'required|exists:stream_masters,id',
            'subject_id'    => 'nullable|exists:subjects,id',
            'teacher_id'    => 'nullable',
            'platform'      => 'required|in:google_meet,zoom,microsoft_teams,other',
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'meeting_link'  => 'nullable|string|max:1000',
            'meeting_id'    => 'nullable|string|max:255',
            'password'      => 'nullable|string|max:255',
            'held_date'     => 'required|date',
            'held_time'     => 'required',
            'duration'      => 'nullable|integer|min:1',
            'status'        => 'required|in:scheduled,ongoing,completed,cancelled',
        ]);

        DB::beginTransaction();

        try {

            $duplicate = $this->isDuplicate(
                OnlineClass::class,
                [
                    'class_id'   => $request->class_id,
                    'section_id' => $request->section_id,
                    'subject_id' => $request->subject_id,
                    'held_date'  => $request->held_date,
                    'held_time'  => $request->held_time,
                ],
                $request->online_class_id
            );

            if ($duplicate) {
                return response()->json([
                    'status' => false,
                    'message' => 'Online class already scheduled for this date and time.'
                ]);
            }

            OnlineClass::updateOrCreate(
                [
                    'id' => $request->online_class_id
                ],
                [
                    'class_id'      => $request->class_id,
                    'section_id'    => $request->section_id,
                    'stream_id'    => $request->stream_id,
                    'subject_id'    => $request->subject_id,
                    'teacher_id'    => $request->teacher_id,
                    'platform'      => $request->platform,
                    'title'         => $request->title,
                    'description'   => $request->description,
                    'meeting_link'  => $request->meeting_link,
                    'meeting_id'    => $request->meeting_id,
                    'password'      => $request->password,
                    'held_date'     => $request->held_date,
                    'held_time'     => $request->held_time,
                    'duration'      => $request->duration,
                    'status'        => $request->status,
                    'session_id'    => activeSession()->id ?? null,
                    'created_by'    => Auth::id(),
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('online_class_id')
                    ? 'Online class updated successfully'
                    : 'Online class scheduled successfully'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            OnlineClass::class,
            [
                'class',
                'section',
                'subject',
                'session',
                'creator'
            ]
        );
    }

    public function fetch()
    {
        return $this->commonFetch(
            OnlineClass::class
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            OnlineClass::class,
            $request,
            [
                'class',
                'section',
                'subject',
                'session',
                'creator'
            ]
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            OnlineClass::class,
            $request
        );
    }

    public function status(Request $request)
    {
        return $this->updateRecordField(
            OnlineClass::class,
            $request,
            'status',
            [
                'scheduled',
                'ongoing',
                'completed',
                'cancelled'
            ]
        );
    }
    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            OnlineClass::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            OnlineClass::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            OnlineClass::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            OnlineClass::class,
            $request
        );
    }
}
