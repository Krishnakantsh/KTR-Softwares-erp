<?php

namespace App\Http\Controllers\Student;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\ManageStudentHostel;
use App\Models\ManageStudentTransport;
use App\Models\Student\Student;
use App\Models\Student\StudentBankDetail;
use App\Models\Student\StudentContactDetail;
use App\Models\Student\StudentDocument;
use App\Models\Student\StudentEducationDetail;
use App\Models\Student\StudentParent;
use App\Models\Student\StudentPersonalDetail;
use App\Models\Student\StudentPreviousDetail;
use App\Models\StudentPromotion;
use App\Traits\CommonCrudOperations;
use Illuminate\Support\Facades\Log;
use App\Services\FileService;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    use CommonCrudOperations;


    public function index()
    {
        return view('Frontend.Normal.Pages.Student.main');
    }

    public function assign_roll_no()
    {
        return view('Frontend.Normal.Pages.Student.assign_roll_no');
    }

    public function store(Request $request)
    {


        DB::beginTransaction();

        try {

            $request->validate([
                'admission_no' => 'required|string|max:255',
                'first_name'   => 'required|string|max:255',
                'class_id'     => 'nullable|exists:class_masters,id',
                'section_id'   => 'nullable|exists:class_sections,id',
                'stream_id'    => 'nullable|exists:stream_masters,id',
                'student_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'admission_date' => 'nullable|date',
                'dob' => 'nullable|date',

                'father_mobile' => 'nullable|string|max:20',
                'mother_mobile' => 'nullable|string|max:20',

                'aadhaar_no' => 'nullable|string|max:20',

                'email' => 'nullable|email',

                'account_no' => 'nullable|string|max:50',
                'ifsc_code' => 'nullable|string|max:20',
            ]);


            $duplicate = $this->isDuplicateAny(
                Student::class,
                [
                    'admission_no' => $request->admission_no,
                    'sr_no'        => $request->sr_no,
                    'enroll_no'    => $request->enroll_no,
                ],
                $request->student_id
            );

            if ($duplicate) {
                return response()->json([
                    'status' => false,
                    'message' => 'Admission No / SR No / Enrollment No already exists.'
                ]);
            }


            $sessionId = activeSession()->id ?? null;
            $studentPhoto = null;
            $student = null;

            if (!empty($request->student_id)) {
                // get student first 
                $student = Student::findOrFail($request->student_id);
            }


            $studentPhoto = $student->student_photo ?? null;

            if ($request->hasFile('student_photo')) {

                $studentPhoto = FileService::update(
                    $request->file('student_photo'),
                    'uploads/student/photo',
                    $student->student_photo ?? null
                );
            }

            $student = Student::updateOrCreate(

                [
                    'id' => $request->student_id ?: 0
                ],

                [

                    'session_id' => $sessionId,
                    'roll_no' => $request->roll_no ?? 0,
                    'comp_no' => $request->comp_no ?? 0,
                    'sr_no' => $request->sr_no ?? 0,
                    'admission_no' => $request->admission_no ?? 0,
                    'enroll_no' => $request->enroll_no,
                    'permanent_edu_no' => $request->permanent_edu_no,
                    'class_id' => $request->class_id,
                    'section_id' => $request->section_id,
                    'stream_id' => $request->stream_id,
                    'house_id' => $request->house_id,
                    'fee_type' => $request->fee_type,
                    'student_type' => $request->student_type,
                    'student_status' => $request->student_status,
                    'admission_date' => $request->admission_date,
                    'dob' => $request->dob,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'father_name' => $request->father_name,
                    'mother_name' => $request->mother_name,
                    'father_mobile' => $request->father_mobile,
                    'mother_mobile' => $request->mother_mobile,
                    'sms_whatsapp_no' => $request->sms_whatsapp_no,
                    'is_Transport_apply' => $request->is_Transport_apply,
                    'is_Hostel_apply' => $request->is_Hostel_apply,
                    'contact_person_name' => $request->contact_person_name,
                    'tc_no' => $request->tc_no,
                    'manual_tc_no' => $request->manual_tc_no,
                    'reason' => $request->reason,
                    'comment' => $request->comment,
                    'student_photo' => $studentPhoto,
                    'is_ews' => $request->boolean('is_ews'),
                    'is_study_material' => $request->boolean('is_study_material'),
                    'is_physically_challenged' => $request->boolean('is_physically_challenged'),
                    'search_query' => $this->generateStudentSearchQuery([
                        'sr_no' => $request->sr_no,
                        'admission_no' => $request->admission_no,
                        'enroll_no' => $request->enroll_no,
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                    ])

                ]
            );

            /*
            |--------------------------------------------------------------------------
            | CONTACT DETAIL
            |--------------------------------------------------------------------------
            */

            StudentContactDetail::updateOrCreate(

                [
                    'student_id' => $student->id
                ],

                [

                    'present_address' => $request->present_address,
                    'present_city' => $request->present_city,
                    'present_postal_code' => $request->present_postal_code,

                    'permanent_address' => $request->permanent_address,
                    'permanent_city' => $request->permanent_city,
                    'permanent_postal_code' => $request->permanent_postal_code,

                    'post_office' => $request->post_office,
                    'police_station' => $request->police_station,
                    'district' => $request->district,
                    'tehsil' => $request->tehsil,

                    'birth_place' => $request->birth_place,

                    'country' => $request->country,

                    'contact_person_phone' => $request->contact_person_phone,
                    'contact_person_email' => $request->contact_person_email,
                    'contact_person_address' => $request->contact_person_address,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | PERSONAL DETAIL
            |--------------------------------------------------------------------------
            */

            StudentPersonalDetail::updateOrCreate(

                [
                    'student_id' => $student->id
                ],

                [
                    'nationality' => $request->nationality,
                    'caste' => $request->caste,
                    'religion' => $request->religion,
                    'category' => $request->category,
                    'blood_group' => $request->blood_group,
                    'aadhaar_no' => $request->aadhaar_no,
                    'email' => $request->email,
                    'apaar_id' => $request->apaar_id,
                    'passport_no' => $request->passport_no,

                    'nic' => $request->nic,
                    'bpl_card' => $request->bpl_card,
                    'saral_id' => $request->saral_id,
                    'family_id' => $request->family_id,

                    'mother_tongue' => $request->mother_tongue,

                    'height' => $request->height,
                    'weight' => $request->weight,

                    'donation_amount' => $request->donation_amount ?? 0,
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | PREVIOUS DETAIL
            |--------------------------------------------------------------------------
            */

            StudentPreviousDetail::updateOrCreate(

                [
                    'student_id' => $student->id
                ],
                [
                    'previous_school_name' => $request->previous_school_name,
                    'previous_class_name' => $request->previous_class_name,
                    'previous_passout_year' => $request->previous_passout_year,
                    'previous_registration_no' => $request->previous_registration_no,
                    'previous_roll_no' => $request->previous_roll_no,
                    'previous_board' => $request->previous_board,
                    'previous_subjects' => $request->previous_subjects,
                    'previous_result' => $request->previous_result,
                    'previous_marks' => $request->previous_marks,
                    'previous_percentage' => $request->previous_percentage,
                    'having_transfer_certificate' => $request->boolean('having_transfer_certificate'),
                ]
            );

            /*
            |--------------------------------------------------------------------------
            | BANK DETAIL
            |--------------------------------------------------------------------------
            */

            StudentBankDetail::updateOrCreate(

                [
                    'student_id' => $student->id
                ],

                [
                    'bank_name' => $request->bank_name,
                    'account_no' => $request->account_no,
                    'account_holder_name' => $request->account_holder_name,
                    'ifsc_code' => $request->ifsc_code,
                ]
            );

            $educationIds = [];

            if (!empty($request->education)) {

                foreach ($request->education as $education) {

                    if (
                        empty($education['course']) &&
                        empty($education['board_name']) &&
                        empty($education['roll_no'])
                    ) {
                        continue;
                    }

                    $record = StudentEducationDetail::updateOrCreate(

                        [
                            'id' => $education['id'] ?? 0,
                            'student_id' => $student->id
                        ],

                        [
                            'course'       => $education['course'] ?? null,
                            'board_name'   => $education['board_name'] ?? null,
                            'roll_no'      => $education['roll_no'] ?? null,
                            'passing_year' => $education['passing_year'] ?? null,
                            'marks'        => $education['marks'] ?? null,
                            'obtain'       => $education['obtain'] ?? null,
                            'percentage'   => $education['percentage'] ?? null,
                        ]
                    );

                    $educationIds[] = $record->id;
                }
            }

            if (!empty($educationIds)) {

                StudentEducationDetail::where('student_id', $student->id)
                    ->whereNotIn('id', $educationIds)
                    ->delete();
            } else {

                StudentEducationDetail::where('student_id', $student->id)
                    ->delete();
            }

            $parentIds = [];

            if (!empty($request->parents)) {

                foreach ($request->parents as $parent) {

                    if (empty($parent['parent_type'])) {
                        continue;
                    }
                    $record = StudentParent::updateOrCreate(
                        [
                            'id' => $parent['id'] ?? 0,
                            'student_id' => $student->id
                        ],

                        [
                            'parent_type' => strtolower($parent['parent_type']),

                            'name' => $parent['name'] ?? null,
                            'dob' => $parent['dob'] ?? null,

                            'phone' => $parent['phone'] ?? null,
                            'email' => $parent['email'] ?? null,

                            'aadhaar_no' => $parent['aadhaar_no'] ?? null,
                            'pan_no' => $parent['pan_no'] ?? null,

                            'occupation' => $parent['occupation'] ?? null,
                            'designation' => $parent['designation'] ?? null,
                            'qualification' => $parent['qualification'] ?? null,
                            'department' => $parent['department'] ?? null,

                            'annual_income' => $parent['annual_income'] ?? 0,

                            'address' => $parent['address'] ?? null,

                            'bpl_card' => $parent['bpl_card'] ?? null,

                            'is_alive' => $parent['is_alive'] ?? true,

                            'business_detail' => $parent['business_detail'] ?? null,

                            'company_name' => $parent['company_name'] ?? null,

                            'office_phone' => $parent['office_phone'] ?? null,
                            'office_email' => $parent['office_email'] ?? null,
                            'office_website' => $parent['office_website'] ?? null,

                            'office_address' => $parent['office_address'] ?? null,

                            'samagra_id' => $parent['samagra_id'] ?? null,

                            'remark' => $parent['remark'] ?? null,
                        ]
                    );

                    $parentIds[] = $record->id;
                }
            }

            if (!empty($parentIds)) {

                StudentParent::where('student_id', $student->id)
                    ->whereNotIn('id', $parentIds)
                    ->delete();
            } else {
                StudentParent::where('student_id', $student->id)
                    ->delete();
            }


            $documentIds = [];

            if (!empty($request->documents)) {

                foreach ($request->documents as $index => $document) {

                    if (
                        empty($document['doc_type']) &&
                        !$request->hasFile("documents.$index.file_blob")
                    ) {
                        continue;
                    }

                    $existingDocument = null;

                    if (!empty($document['id'])) {

                        $existingDocument = StudentDocument::find($document['id']);
                    }

                    $documentFile = $existingDocument->document_file ?? null;

                    if ($request->hasFile("documents.$index.file_blob")) {

                        $documentFile = FileService::update(

                            $request->file("documents.$index.file_blob"),

                            'uploads/student/documents/student_id_' . $student->id,

                            $existingDocument->document_file ?? null
                        );
                    }

                    $record = StudentDocument::updateOrCreate(
                        [
                            'id' => $document['id'] ?? 0,
                            'student_id' => $student->id
                        ],
                        [

                            'document_name' => $document['doc_type'] ?? null,

                            'document_remark' => $document['document_remark'] ?? null,

                            'document_file' => $documentFile,
                        ]
                    );

                    $documentIds[] = $record->id;
                }
            }

            if (!empty($documentIds)) {

                $removedDocuments = StudentDocument::where('student_id', $student->id)
                    ->whereNotIn('id', $documentIds)
                    ->get();

                foreach ($removedDocuments as $doc) {

                    FileService::delete($doc->document_file);
                }

                StudentDocument::where('student_id', $student->id)
                    ->whereNotIn('id', $documentIds)
                    ->delete();
            } else {

                $documents = StudentDocument::where(
                    'student_id',
                    $student->id
                )->get();

                foreach ($documents as $doc) {

                    FileService::delete($doc->document_file);
                }

                StudentDocument::where(
                    'student_id',
                    $student->id
                )->delete();
            }



            if ($student->is_Transport_apply) {

                ManageStudentTransport::updateOrCreate(

                    [
                        'student_id' => $student->id
                    ],

                    [
                        'route_id' => $request->route_id,
                        'vehicle_id' => $request->vehicle_id,
                        'destination_id' => $request->destination_id,
                        'apply_date' => $request->apply_date
                            ?? now()->toDateString(),

                        'status' => true,



                        'session_id' => activeSession()->id ?? null,

                        'created_by' => Auth::id(),

                        'updated_by' =>  Auth::id(),
                    ]
                );
            } else {

                ManageStudentTransport::where(
                    'student_id',
                    $student->id
                )->delete();
            }

            if ($student->is_Hostel_apply) {

                ManageStudentHostel::updateOrCreate(

                    [
                        'student_id' => $student->id
                    ],
                    [

                        'hostel_id' => $request->hostel_id,
                        'block_id'  => $request->block_id,
                        'floor_id'  => $request->floor_id,
                        'room_id'   => $request->room_id,

                        'apply_date' => $request->hostel_apply_date
                            ?? now()->toDateString(),

                        'status' => true,

                        'remarks' => $request->remark,

                        'session_id' => activeSession()->id ?? null,

                        'created_by' => Auth::id(),

                        'updated_by' =>  Auth::id(),
                    ]
                );
            } else {

                ManageStudentHostel::where(
                    'student_id',
                    $student->id
                )->delete();
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'student_id' => $student->id,
                'message' => $request->filled('student_id')
                    ? 'Student updated successfully.'
                    : 'Student registered successfully.'
            ]);
        } catch (Exception $e) {

            DB::rollBack();

            Log::error('Student Store Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }


    public function fetchWith()
    {
        return $this->commonFetch(
            Student::class,
            [
                'classMaster',
                'section',
                'stream',
                'house',

                'contactDetail',
                'personalDetail',
                'previousDetail',
                'bankDetail',

                'education',
                'transport',
                'hostel',
                'parents',
            ]
        );
    }

    public function fetch()
    {
        return $this->commonFetch(Student::class, [],['session_id'=> activeSession()->id]);
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            Student::class,
            $request,
            [
                'classMaster',
                'section',
                'stream',
                'house',

                'contactDetail',
                'personalDetail',
                'previousDetail',
                'bankDetail',

                'education',
                'parents',
                'transport',
                'hostel',

                'documents',
                'objections'
            ]
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            Student::class,
            $request
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            Student::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            Student::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            Student::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            Student::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            Student::class,
            $request
        );
    }

    // public function getStudentsForPromotionAndDemotion(Request $request)
    // {
    //     $students = [];
    //     $session_id = null;

    //     if ($request->type === 'source') {

    //         $session_id = $request->session_id;
    //     } else {
    //         // next session
    //         $nextSession = AcademicSession::where('start_year', $request->start_year + 1)
    //             ->where('end_year', $request->end_year + 1)
    //             ->first();

    //         $session_id = $nextSession?->id;
    //     }

    //     $conditions = [
    //         'session_id' => $session_id,
    //         'class_id'   => $request->class_id,
    //         'section_id' => $request->section_id,
    //     ];

    //     return     $this->commonFetch(Student::class, ['classMaster', 'section'], $conditions, null, null, null, null, null, ['id', 'admission_no', 'sr_no', 'first_name', 'last_name', 'father_name']);
    // }


    public function getStudentsForPromotionAndDemotion(Request $request)
    {
        $session_id = null;
        $nextSessionId = null;

        if ($request->type === 'source') {

            $session_id = $request->session_id;

            $sourceSession = AcademicSession::find($session_id);

            $nextSession = AcademicSession::where(
                'start_year',
                $sourceSession->start_year + 1
            )
                ->where(
                    'end_year',
                    $sourceSession->end_year + 1
                )
                ->first();

            $nextSessionId = $nextSession?->id;
        } else {

            $nextSession = AcademicSession::where(
                'start_year',
                $request->start_year + 1
            )
                ->where(
                    'end_year',
                    $request->end_year + 1
                )
                ->first();

            $session_id = $nextSession?->id;
        }

        $students = Student::select(
            'id',
            'admission_no',
            'sr_no',
            'first_name',
            'last_name',
            'father_name'
        )
            ->where([
                'session_id' => $session_id,
                'class_id'   => $request->class_id,
                'section_id' => $request->section_id,
            ])
            ->get();

        if ($request->type === 'source' && $nextSessionId) {

            $students->transform(function ($student) use ($nextSessionId) {

                $student->isPromoted = Student::where(
                    'admission_no',
                    $student->admission_no
                )
                    ->where(
                        'session_id',
                        $nextSessionId
                    )
                    ->exists();

                return $student;
            });
        }

        return response()->json([
            'status' => true,
            'data'   => $students
        ]);
    }


    public function promoteAndDemoteStudents(Request $request)
    {


        DB::beginTransaction();

        try {

            $studentIds = $request->student_ids;

            $actionType = $request->action_type;

            $successCount = 0;
            $alreadyPromotedCount = 0;
            $failedCount = 0;

            if (empty($studentIds)) {

                return response()->json([
                    'status' => false,
                    'message' => 'No students selected'
                ]);
            }

            $sourceSession = AcademicSession::find($request->source_session_id);

            $targetSession = AcademicSession::where(
                'start_year',
                $sourceSession->start_year + 1
            )
                ->where(
                    'end_year',
                    $sourceSession->end_year + 1
                )
                ->first();

            $actionLabel = $actionType === 'promotion'  ? 'Promoted' : 'Demoted';

            // dd($targetSession->toArray());

            if (!$targetSession) {

                return response()->json([
                    'status' => false,
                    'message' => 'Target session not found.'
                ]);
            }

            foreach ($studentIds as $studentId) {

                try {

                    $student = Student::find($studentId);

                    if (!$student) {
                        $failedCount++;
                        continue;
                    }


                    if ($actionType == 'promotion') {

                        /*
                        |----------------------------------------------------------
                        | Already Exists In Target Session
                        |----------------------------------------------------------
                        */

                        $alreadyStudent = Student::where('admission_no', $student->admission_no)
                            ->where('session_id', $targetSession->id)
                            ->first();
                        // dd($alreadyStudent);    

                        if ($alreadyStudent) {
                            $alreadyPromotedCount++;
                            continue;
                        }

                        /*
                        |----------------------------------------------------------
                        | Clone Student
                        |----------------------------------------------------------
                        */

                        $newStudent = $student->replicate();

                        $newStudent->session_id =  $targetSession->id;

                        $newStudent->class_id = $request->target_class_id;

                        $newStudent->section_id = $request->target_section_id;

                        $newStudent->created_at = now();
                        $newStudent->updated_at = now();

                        $newStudent->save();

                        /*
                        |----------------------------------------------------------
                        | Promotion Entry
                        |----------------------------------------------------------
                        */

                        StudentPromotion::create([

                            'student_id'      => $newStudent->id,

                            'from_session_id' => $student->session_id,
                            'from_class_id'   => $student->class_id,
                            'from_section_id' => $student->section_id,

                            'to_session_id'   => $targetSession->id,
                            'to_class_id'     => $request->target_class_id,
                            'to_section_id'   => $request->target_section_id,

                            'promotion_date'  => now()->toDateString(),
                            'promoted_by'     => Auth::id(),
                        ]);

                        $successCount++;
                    }

                    /*
                    |----------------------------------------------------------
                    | Demotion
                    |----------------------------------------------------------
                    */

                    if ($actionType == 'demotion') {

                        StudentPromotion::where(
                            'student_id',
                            $student->id
                        )->delete();

                        $student->delete();

                        $successCount++;
                    }
                } catch (\Exception $e) {

                    $failedCount++;
                }
            }

            DB::commit();


            $totalSelected = count($studentIds);

            $message =
                "Student {$actionType} process completed.\n\n" .

                "Total Selected Students : {$totalSelected}\n" .

                "Successfully {$actionLabel} : {$successCount}\n";

            if ($actionType === 'promotion') {
                $message .= "Already Promoted : {$alreadyPromotedCount}\n";
            }

            $message .= "Failed : {$failedCount}";

            return response()->json([

                'status' => true,

                'message' => $message

            ]);
        } catch (\Exception $e) {


            DB::rollBack();


            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
