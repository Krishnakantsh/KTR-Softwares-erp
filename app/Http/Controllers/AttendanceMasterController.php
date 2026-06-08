<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\AttendanceMaster;
use App\Models\AttendanceDetail;
use App\Models\Student\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonCrudOperations;
use Throwable;

class AttendanceMasterController extends Controller
{
    use CommonCrudOperations;

    public function index()
    {
        return view('Frontend/Normal/Pages/Student/attendance');
    }


    public function fetchStudents(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'attendance_date' => 'required|date',
        ]);

        $attendanceMaster = AttendanceMaster::with('details')
            ->where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->whereDate('attendance_date', $request->attendance_date)
            ->first();

        $attendanceMap = [];

        if ($attendanceMaster) {

            $attendanceMap = $attendanceMaster
                ->details
                ->pluck(
                    'attendance_status',
                    'student_id'
                )
                ->toArray();
        }

        $students = $this->commonFetch(
            Student::class,
            [],
            [
                'class_id'   => $request->class_id,
                'section_id' => $request->section_id,
                'is_active'  => 1
            ],
            'roll_no',
            'asc',
            null,
            null,
            'collection'
        )->map(function ($student) use ($attendanceMap) {

            $student->attendance_status =
                $attendanceMap[$student->id] ?? 'P';

            return $student;
        });

        return response()->json([
            'status' => true,
            'attendance_exists' => !empty($attendanceMaster),
            'data' => $students
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id'        => 'required|exists:class_masters,id',
            'section_id'      => 'required|exists:class_sections,id',
            'stream_id'       => 'nullable|exists:stream_masters,id',
            'subject_id'      => 'nullable|exists:subjects,id',
            'teacher_id'      => 'nullable',
            'attendance_date' => 'required|date',

            'students' => 'required|array|min:1',

            'students.*.student_id' => 'required|exists:students,id',
            'students.*.status'     => 'required|in:P,A,L,H',
            'students.*.remarks'    => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $attendanceMaster = AttendanceMaster::updateOrCreate(
                [
                    'class_id'        => $request->class_id,
                    'section_id'      => $request->section_id,
                    'subject_id'      => $request->subject_id,
                    'attendance_date' => $request->attendance_date,
                ],
                [
                    'stream_id'    => $request->stream_id,
                    'teacher_id'   => $request->teacher_id ?? null,
                    'session_id'   => activeSession()->id ?? null,
                    'created_by'   => Auth::id(),
                    'updated_by'   => Auth::id(),
                ]
            );

            $now = now();

            $attendanceDetails = [];

            foreach ($request->students as $student) {

                $attendanceDetails[] = [
                    'attendance_master_id' => $attendanceMaster->id,
                    'student_id'           => $student['student_id'],
                    'attendance_status'    => $student['status'],
                    'remarks'              => $student['remarks'] ?? null,
                    'created_at'           => $now,
                    'updated_at'           => $now,
                ];
            }

            AttendanceDetail::upsert(
                $attendanceDetails,

                [
                    'attendance_master_id',
                    'student_id'
                ],

                [
                    'attendance_status',
                    'remarks',
                    'updated_at'
                ]
            );

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $request->filled('attendance_master_id')
                    ? 'Attendance updated successfully.'
                    : 'Attendance saved successfully.'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            AttendanceMaster::class,
            [
                'class',
                'section',
                'subject',
                'teacher',
                'details.student'
            ]
        );
    }

    public function fetch()
    {
        return $this->commonFetch(
            AttendanceMaster::class
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            AttendanceMaster::class,
            $request,
            [
                'class',
                'section',
                'subject',
                'teacher',
                'details.student'
            ]
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            AttendanceMaster::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            AttendanceMaster::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            AttendanceMaster::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            AttendanceMaster::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            AttendanceMaster::class,
            $request
        );
    }


    // extra methods 
    public function get_attendence_data(Request $request)
    {
        try {

            $attendanceDate = $request->attendance_date;

            $data = AttendanceMaster::with([
                'class:id,name',
                'section:id,name'
            ])
                ->withCount([
                    'details as total_students',

                    'details as present_count' => function ($q) {
                        $q->where('attendance_status', 'P');
                    },

                    'details as absent_count' => function ($q) {
                        $q->where('attendance_status', 'A');
                    },

                    'details as leave_count' => function ($q) {
                        $q->where('attendance_status', 'L');
                    },

                    'details as holiday_count' => function ($q) {
                        $q->where('attendance_status', 'H');
                    }
                ])
                ->whereDate('attendance_date', $attendanceDate)
                ->get();

            return response()->json([
                'status' => true,
                'data'   => $data,
            ]);
        } catch (Throwable $th) {

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
