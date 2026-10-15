<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class BiometricAttendanceLog extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Punch Type
    |--------------------------------------------------------------------------
    */

    const PUNCH_IN = 1;
    const PUNCH_OUT = 2;
    const PUNCH_BREAK_IN = 3;
    const PUNCH_BREAK_OUT = 4;
    const PUNCH_UNKNOWN = 5;


    /*
    |--------------------------------------------------------------------------
    | Verification Type
    |--------------------------------------------------------------------------
    */

    const VERIFICATION_FINGERPRINT = 1;
    const VERIFICATION_FACE = 2;
    const VERIFICATION_CARD = 3;
    const VERIFICATION_PIN = 4;
    const VERIFICATION_PASSWORD = 5;
    const VERIFICATION_OTHER = 6;


    /*
    |--------------------------------------------------------------------------
    | Source
    |--------------------------------------------------------------------------
    */

    const SOURCE_DEVICE = 1;
    const SOURCE_API = 2;
    const SOURCE_IMPORT = 3;
    const SOURCE_MANUAL_SYNC = 4;


    /*
    |--------------------------------------------------------------------------
    | Sync Status
    |--------------------------------------------------------------------------
    */

    const SYNC_RECEIVED = 1;
    const SYNC_PROCESSED = 2;
    const SYNC_FAILED = 3;
    const SYNC_IGNORED = 4;


    protected $fillable = [

        'school_id',
        'branch_id',

        'attendance_device_id',

        'employee_id',

        'biometric_id',
        'device_user_id',

        'punch_at',

        'punch_type',

        'verification_type',

        'device_serial_number',
        'device_punch_id',

        'raw_payload',

        'source',
        'sync_status',

        'is_processed',
        'processed_at',

        'event_hash',
        'is_duplicate',

        'processing_error',
        'attempt_count',

        'employee_attendance_id',

        'received_at',
    ];


    protected $casts = [

        'punch_at' => 'datetime',

        'punch_type' => 'integer',

        'verification_type' => 'integer',

        'raw_payload' => 'array',

        'source' => 'integer',

        'sync_status' => 'integer',

        'is_processed' => 'boolean',

        'processed_at' => 'datetime',

        'is_duplicate' => 'boolean',

        'attempt_count' => 'integer',

        'received_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function school()
    {
        return $this->belongsTo(
            \App\Models\School::class
        );
    }

    public function branch()
    {
        return $this->belongsTo(
            Branch::class
        );
    }

    public function attendanceDevice()
    {
        return $this->belongsTo(
            AttendanceDevice::class
        );
    }

    public function employee()
    {
        return $this->belongsTo(
            Employee::class
        );
    }

    public function employeeAttendance()
    {
        return $this->belongsTo(
            EmployeeAttendance::class
        );
    }
}