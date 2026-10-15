<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employment extends BaseModel
{
      use SoftDeletes;
      /*
      |--------------------------------------------------------------------------
      | Employment Status
      |--------------------------------------------------------------------------
      */

      const STATUS_ACTIVE = 1;
      const STATUS_PROBATION = 2;
      const STATUS_NOTICE_PERIOD = 3;
      const STATUS_SUSPENDED = 4;
      const STATUS_RESIGNED = 5;
      const STATUS_TERMINATED = 6;
      const STATUS_RETIRED = 7;
      const STATUS_LEFT = 8;


      /*
      |--------------------------------------------------------------------------
      | Leaving Reasons
      |--------------------------------------------------------------------------
      */

      const LEAVING_RESIGNATION = 1;
      const LEAVING_TERMINATION = 2;
      const LEAVING_RETIREMENT = 3;
      const LEAVING_CONTRACT_END = 4;
      const LEAVING_TRANSFER = 5;
      const LEAVING_OTHER = 6;


      /*
      |--------------------------------------------------------------------------
      | Attendance Modes
      |--------------------------------------------------------------------------
      */

      const ATTENDANCE_MANUAL = 1;
      const ATTENDANCE_BIOMETRIC = 2;
      const ATTENDANCE_RFID = 3;
      const ATTENDANCE_FACE = 4;
      const ATTENDANCE_MOBILE = 5;
      const ATTENDANCE_MULTIPLE = 6;


      protected $fillable = [

            // Organization
            'school_id',
            'branch_id',
            'department_id',
            'designation_id',
            'employment_type_id',

            // Identity
            'employee_code',
            'employee_number',

            // Biometric / Attendance
            'biometric_id',
            'attendance_device_user_id',
            'rfid_card_number',

            // Employment
            'joining_date',
            'confirmation_date',
            'probation_start_date',
            'probation_end_date',
            'leaving_date',
            'employment_status',

            // Leaving
            'leaving_reason',
            'leaving_remarks',

            // Reporting
            'reporting_manager_id',

            // Attendance
            'attendance_mode',

            // Configuration
            'is_attendance_required',
            'is_payroll_applicable',

            // Documents
            'joining_letter',
            'resignation_letter',

            // Status
            'status',

            'remarks',
      ];


      protected $casts = [

            'joining_date' => 'date',
            'confirmation_date' => 'date',

            'probation_start_date' => 'date',
            'probation_end_date' => 'date',

            'leaving_date' => 'date',

            'employment_status' => 'integer',
            'leaving_reason' => 'integer',

            'attendance_mode' => 'integer',

            'is_attendance_required' => 'boolean',
            'is_payroll_applicable' => 'boolean',

            'status' => 'boolean',
      ];


      /*
      |--------------------------------------------------------------------------
      | Relationships
      |--------------------------------------------------------------------------
      */

      public function employee()
      {
            return $this->belongsTo(Employee::class);
      }

      public function school()
      {
            return $this->belongsTo(\App\Models\School::class);
      }

      public function branch()
      {
            return $this->belongsTo(Branch::class);
      }

      public function department()
      {
            return $this->belongsTo(Department::class);
      }

      public function designation()
      {
            return $this->belongsTo(Designation::class);
      }

      public function employmentType()
      {
            return $this->belongsTo(EmploymentType::class);
      }

      public function generalInformation()
      {
            return $this->hasOne(EmployeeGeneralInformation::class);
      }

      public function reportingManager()
      {
            return $this->belongsTo(
                  Employee::class,
                  'reporting_manager_id'
            );
      }

      public function teamMembers()
      {
            return $this->hasMany(
                  Employee::class,
                  'reporting_manager_id'
            );
      }

      public function documents()
      {
            return $this->hasMany(EmployeeDocument::class);
      }

      public function attendanceDevices()
      {
            return $this->hasMany(EmployeeAttendanceDevice::class);
      }

      public function primaryAttendanceDevice()
      {
            return $this->hasOne(EmployeeAttendanceDevice::class)
                  ->where('is_primary', true)
                  ->where('status', true);
      }

      public function leaveAssignments()
      {
            return $this->hasMany(
                  EmployeeLeaveAssignment::class
            );
      }

      public function activeLeaveAssignments()
      {
            return $this->hasMany(
                  EmployeeLeaveAssignment::class
            )
                  ->where(
                        'status',
                        EmployeeLeaveAssignment::STATUS_ACTIVE
                  )
                  ->where(
                        'approval_status',
                        EmployeeLeaveAssignment::APPROVAL_APPROVED
                  );
      }
}
