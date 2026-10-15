<?php

namespace App\Http\Controllers\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Payroll\Employee;
use App\Models\Payroll\EmployeeDocument;
use App\Models\Payroll\Employment;
use App\Services\Auth\SchoolAppUserService;
use App\Services\FileService;
use App\Traits\CommonCrudOperations;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    use CommonCrudOperations;


    public function index()
    {

        return view("School.Pages.Payroll.PayrollMaster.employee");
    }

    public function dashboard()
    {
        return "Jai Shri Ram";
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'nullable|exists:employees,id',
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'display_name' => 'nullable|string|max:200',
            'gender' => 'nullable|integer|in:1,2,3',
            'date_of_birth' => 'nullable|date',
            'blood_group' => 'nullable|string|max:10',
            'father_name' => 'nullable|string|max:200',
            'mother_name' => 'nullable|string|max:200',
            'marital_status' => 'nullable|integer|in:1,2,3,4,5',
            'spouse_name' => 'nullable|string|max:200',
            'personal_email' => 'nullable|email|max:255',
            'personal_mobile' => 'nullable|string|max:20',
            'alternate_mobile' => 'nullable|string|max:20',
            'emergency_contact_name' => 'nullable|string|max:200',
            'emergency_contact_relation' => 'nullable|string|max:100',
            'emergency_contact_mobile' => 'nullable|string|max:20',
            'profile_photo' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
            'status' => 'nullable|boolean',

            'branch_id' => 'nullable|exists:branches,id',
            'department_id' => 'nullable|exists:departments,id',
            'designation_id' => 'nullable|exists:designations,id',
            'employment_type_id' => 'nullable|exists:employment_types,id',
            'employee_code' => 'nullable|string|max:50',
            'joining_date' => 'nullable|date',
            'employment_status' => 'nullable|integer',
            'attendance_mode' => 'nullable|integer',

            'documents' => 'nullable|array',
            'documents.*.document_type' => 'nullable|integer',
            'documents.*.file_blob' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        // school name (FileService path helpers isi se path banayenge)
        $schoolName = tenantDatabase();

        DB::beginTransaction();

        try {
            $employee = $request->filled('id')
                ? Employee::findOrFail($request->id)
                : new Employee();

            $employee->fill($request->only([
                'first_name',
                'middle_name',
                'last_name',
                'display_name',
                'gender',
                'date_of_birth',
                'blood_group',
                'father_name',
                'mother_name',
                'spouse_name',
                'personal_email',
                'personal_mobile',
                'alternate_mobile',
                'emergency_contact_name',
                'emergency_contact_relation',
                'emergency_contact_mobile',
                'current_address_line_1',
                'current_address_line_2',
                'current_country',
                'current_state',
                'current_district',
                'current_city',
                'current_area',
                'current_pincode',
                'permanent_address_line_1',
                'permanent_address_line_2',
                'permanent_country',
                'permanent_state',
                'permanent_district',
                'permanent_city',
                'permanent_area',
                'permanent_pincode',
                'notes',
            ]));

            $employee->marital_status = $request->input('marital_status', 1);
            $employee->same_as_permanent_address = $request->boolean('same_as_permanent_address');

            if ($request->hasFile('profile_photo')) {
                $employee->profile_photo = FileService::update(
                    $request->file('profile_photo'),
                    payroll_employee_pic_dir($schoolName, 'relative'),
                    $employee->profile_photo
                );
            }

            $employee->status = $request->boolean('status', true);
            if (!$employee->exists) $employee->created_by = loginId();
            $employee->updated_by = loginId();
            $employee->save();

            $employment = $request->filled('employment_id')
                ? Employment::findOrFail($request->employment_id)
                : new Employment();

            $employment->employee_id = $employee->id;

            $employment->school_id = getSchool()->id;

            $employment->fill($request->only([
                'branch_id',
                'department_id',
                'designation_id',
                'employment_type_id',
                'employee_code',
                'employee_number',
                'biometric_id',
                'attendance_device_user_id',
                'rfid_card_number',
                'joining_date',
                'confirmation_date',
                'probation_start_date',
                'probation_end_date',
                'leaving_date',
                'employment_status',
                'leaving_reason',
                'leaving_remarks',
                'reporting_manager_id',
                'attendance_mode',
                'remarks',
            ]));

            $employment->is_attendance_required = $request->boolean('is_attendance_required');
            $employment->is_payroll_applicable = $request->boolean('is_payroll_applicable');

            $employment->status = $request->boolean('status', true);
            if (!$employment->exists) $employment->created_by = loginId();
            $employment->updated_by = loginId();
            $employment->save();

            // ---------- 3. DOCUMENTS ----------
            if ($request->has('documents')) {
                foreach ($request->documents as $doc) {

                    $document = !empty($doc['id'])
                        ? EmployeeDocument::find($doc['id'])
                        : new EmployeeDocument();

                    $document->employee_id = $employee->id;
                    $document->document_type = $doc['document_type'] ?? null;
                    $document->document_name = $doc['document_name'] ?? null;
                    $document->document_number = $doc['document_number'] ?? null;
                    $document->is_primary = ($doc['is_primary'] ?? 0) == 1;
                    $document->remarks = $doc['remarks'] ?? null;

                    if (isset($doc['file_blob']) && $doc['file_blob'] instanceof \Illuminate\Http\UploadedFile) {
                        $file = $doc['file_blob'];

                        // Pehle metadata capture kar lo (file abhi temp path pe maujood hai)
                        $document->file_name = $file->getClientOriginalName();
                        $document->file_extension = $file->getClientOriginalExtension();
                        $document->file_size = $file->getSize();
                        $document->mime_type = $file->getMimeType();

                        // Ab move karo
                        $dir = match ((int) ($doc['document_type'] ?? 0)) {
                            1 => payroll_aadhaar_card_dir($schoolName, 'relative'),
                            2 => payroll_pan_card_dir($schoolName, 'relative'),
                            3 => payroll_employee_signature_dir($schoolName, 'relative'),
                            5 => payroll_voter_id_card_dir($schoolName, 'relative'),
                            default => payroll_other_document_dir($schoolName, 'relative'),
                        };

                        $document->file_path = FileService::update($file, $dir, $document->file_path ?? null);
                    }

                    $document->status = true;
                    if (!$document->exists) $document->created_by = loginId();
                    $document->updated_by = loginId();
                    $document->save();
                }
            }

            SchoolAppUserService::createOrUpdate([
                'registration_id' => $employee->id,
                'school_id'       => schoolId(),
                'mobile_no'       => $employee->personal_mobile,
                'email'           => $employee->personal_email,
                'password' => $employee->personal_mobile ?: $employee->employee_code ?? 'Staff@123',
                'role'            => 'Staff',
            ]);

            // It is used further to delete the documents which are removed from the frontend.

            // if ($request->filled('deleted_documents')) {
            //     EmployeeDocument::whereIn('id', $request->deleted_documents)
            //         ->where('employee_id', $employee->id)
            //         ->delete();
            // }


            DB::commit();

            return response()->json([
                'status' => true,
                'message' => $employee->wasRecentlyCreated ? 'Employee added successfully.' : 'Employee updated successfully.',
                'data' => $employee,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function fetch()
    {
        return $this->commonFetch(
            Employee::class
        );
    }

    public function fetchWith()
    {
        return $this->commonFetch(
            Employee::class
        );
    }

    public function show(Request $request)
    {
        return $this->commonShow(
            Employee::class,
            $request,
            []
        );
    }

    public function showWith(Request $request)
    {
        return $this->commonShow(
            Employee::class,
            $request,
            ['staffDocuments', 'staffEmploymentDetails']
        );
    }

    public function status(Request $request)
    {
        return $this->toggleStatus(
            Employee::class,
            $request
        );
    }

    public function destroy(Request $request)
    {
        return $this->commonDestroy(
            Employee::class,
            $request
        );
    }

    public function trash()
    {
        return $this->commonTrash(
            Employee::class
        );
    }

    public function restore(Request $request)
    {
        return $this->commonRestore(
            Employee::class,
            $request
        );
    }

    public function forceDelete(Request $request)
    {
        return $this->commonForceDelete(
            Employee::class,
            $request
        );
    }
}
