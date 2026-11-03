<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class EmployeeAttendanceDevice extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Enrollment Types
    |--------------------------------------------------------------------------
    */

    const ENROLLMENT_FINGERPRINT = 1;
    const ENROLLMENT_FACE = 2;
    const ENROLLMENT_RFID = 3;
    const ENROLLMENT_PALM = 4;
    const ENROLLMENT_IRIS = 5;
    const ENROLLMENT_MULTIPLE = 6;


    /*
    |--------------------------------------------------------------------------
    | Sync Status
    |--------------------------------------------------------------------------
    */

    const SYNC_PENDING = 1;
    const SYNCED = 2;
    const SYNC_FAILED = 3;
    const SYNC_DISABLED = 4;


    protected $fillable = [

        'employee_id',
        'device_id',

        'device_user_id',
        'biometric_id',
        'rfid_card_number',

        'enrollment_type',

        'enrolled_at',
        'last_synced_at',

        'sync_status',
        'last_sync_error',

        'is_primary',
        'status',
    ];


    protected $casts = [

        'enrollment_type' => 'integer',

        'enrolled_at' => 'datetime',
        'last_synced_at' => 'datetime',

        'sync_status' => 'integer',

        'is_primary' => 'boolean',
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

    public function device()
    {
        return $this->belongsTo(
            AttendanceDevice::class,
            'device_id'
        );
    }
}