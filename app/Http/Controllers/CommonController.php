<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\Hostel_System\HostelBlock;
use App\Models\Hostel_System\HostelFloor;
use App\Models\Hostel_System\RoomMaster;
use App\Models\LibraryMembership;
use App\Models\Student\Student;
use App\Models\Transport\TransportAssignVehicle;
use App\Models\Transport\TransportDestination;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CommonController extends Controller
{
    use CommonCrudOperations;

    public function generateSrNo()
    {
        try {

            $resp = $this->generateStudentSrNo();

            return response()->json([
                'status'  => true,
                'message' => 'SR No generated successfully.',
                'data'    => $resp
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function generateLibraryMembershipNumber()
    {
        try {

            $resp = $this->generateLibraryMembershipNo();

            return response()->json([
                'status'  => true,
                'message' => 'Library Membership Number generated successfully.',
                'data'    => $resp
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function generateAdmissionNo()
    {
        try {
            $resp = $this->generateStudentAdmissionNo();

            return response()->json([
                'status'  => true,
                'message' => 'Admission No generated successfully.',
                'data'    => $resp
            ], 200);
        } catch (Throwable $th) {

            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function generateEnrollmentNo()
    {
        try {
            $resp = $this->generateStudentEnrollmentNo();

            return response()->json([
                'status'  => true,
                'message' => 'Enrollment No generated successfully.',
                'data'    => $resp
            ], 200);
        } catch (Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getClassDevisionsByClassId(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:class_masters,id'
            ]);

            return $this->commonFetch(
                ClassSection::class,
                [],
                [
                    'class_master_id'   => $validated['id'],
                ]
            );
        } catch (Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getDestinationsByRouteId(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:transport_routes,id'
            ]);

            return $this->commonFetch(
                TransportDestination::class,
                [],
                [
                    'transport_route_id'   => $validated['id'],
                ]
            );
        } catch (Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getVehiclesByRouteId(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:transport_routes,id'
            ]);

            return $this->commonFetch(
                TransportAssignVehicle::class,
                ['vehicle'],
                [
                    'transport_route_id'   => $validated['id'],
                ]
            );
        } catch (Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getBlocksByHostelId(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:hostels,id'
            ]);

            return $this->commonFetch(
                HostelBlock::class,
                ['hostel'],
                [
                    'hostel_id'   => $validated['id'],
                ],
                'created_at',
                'asc'
            );
        } catch (Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getFloorsByBlockId(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:hostel_blocks,id'
            ]);

            return $this->commonFetch(
                HostelFloor::class,
                ['block', 'hostel'],
                [
                    'hostel_block_id'   => $validated['id'],
                ]
            );
        } catch (Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getRoomsByFloorId(Request $request)
    {
        try {
            $validated = $request->validate([
                'id' => 'required|exists:hostel_floors,id'
            ]);

            return $this->commonFetch(
                RoomMaster::class,
                ['roomType', 'floor', 'block', 'hostel'],
                [
                    'hostel_floor_id'   => $validated['id'],
                ]
            );
        } catch (Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function searchList()
    {
        $students = Student::select(
            'id as student_id',
            'first_name',
            'last_name',
            'search_query',
            'student_photo',
            'admission_no',
            'sr_no',
            'sms_whatsapp_no',
            'father_name',
            'mother_name'
        )->where('session_id', activeSession()->id)
            ->get()
            ->map(function ($student) {

                $name = trim(
                    $student->first_name . ' ' . $student->last_name
                );

                return [
                    'student_id'   => $student->student_id,
                    'student_name' => $name,
                    'search_query' => $student->search_query,
                    'student_photo' => $student->student_photo,
                    'admission_no' => $student->admission_no,
                    'sr_no' => $student->sr_no,
                    'sms_whatsapp_no' => $student->sms_whatsapp_no,
                    'father_name' => $student->father_name,
                    'mother_name' => $student->mother_name,
                ];
            });

        return response()->json($students);
    }

    // function for assign roll no and feebook and exam-roll number

    public function getStudentsBasedClassSection(Request $request)
    {
        try {
            $validated = $request->validate([
                'class_id' => 'required|exists:class_masters,id',
                'section_id' => 'required|exists:class_sections,id',
            ]);

            return $this->commonFetch(
                Student::class,
                ['classMaster', 'section'],
                [
                    'class_id'   => $validated['class_id'],
                    'section_id'   => $validated['section_id'],
                    'session_id' =>  activeSession()->id
                ]
            );
        } catch (Throwable $th) {
            return response()->json([
                'status'  => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // assign roll no and feebook number here 

    public function assignRollNoExamRollNo(Request $request)
    {
        try {

            $data = json_decode($request->data, true);

            $field = 'roll_no';

            switch ($data['type']) {

                case 'Roll No':
                    $field = 'roll_no';
                    break;

                case 'Exam Roll No':
                    $field = 'exam_rollno';
                    break;

                case 'FeeBook No':
                    $field = 'feebook_no';
                    break;
            }

            foreach ($data['students'] as $student) {
                Student::where('id', $student['student_id'])
                    ->where('session_id', activeSession()->id)
                    ->update([
                        $field => $student['generated_no']
                    ]);
            }

            return response()->json([
                'status' => true,
                'message' => $data['type'] . 'assigned successfully',
            ]);
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function getLibraryMemberWithBooksHistrory(Request $request)
    {
        try {

            // validation
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|min:1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors()
                ], 422);
            }

            // get member with borrow history
            $member = $this->commonGet(
                LibraryMembership::class,
                ['libraryBookBorrowHistory.book', 'student.classMaster','student.section'],
                ['student_id' => $request->id]
            );

            // check member
            if (!$member) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Library member not found.'
                ], 404);
            }

            // check history
            if (
                empty($member->libraryBookBorrowHistory) ||
                $member->libraryBookBorrowHistory->count() == 0
            ) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Library member found, but no book history available.',
                    'data'    => $member
                ]);
            }

            // success
            return response()->json([
                'status'  => true,
                'message' => 'Library member with book history fetched successfully.',
                'data'    => $member
            ]);
        } catch (Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong while fetching library member details.',
                'error'   => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }
}
