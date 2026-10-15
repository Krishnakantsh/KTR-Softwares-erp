<?php

namespace App\Models\Payroll;

use App\Models\BaseModel;

class AttendanceDevice extends BaseModel
{
    /*
    |--------------------------------------------------------------------------
    | Connection Types
    |--------------------------------------------------------------------------
    */

    const CONNECTION_LAN = 1;
    const CONNECTION_WIFI = 2;
    const CONNECTION_INTERNET = 3;
    const CONNECTION_USB = 4;
    const CONNECTION_CLOUD = 5;


    /*
    |--------------------------------------------------------------------------
    | Attendance Direction
    |--------------------------------------------------------------------------
    */

    const DIRECTION_CHECK_IN = 1;
    const DIRECTION_CHECK_OUT = 2;
    const DIRECTION_BOTH = 3;


    /*
    |--------------------------------------------------------------------------
    | Sync Mode
    |--------------------------------------------------------------------------
    */

    const SYNC_PULL = 1;
    const SYNC_PUSH = 2;
    const SYNC_BOTH = 3;
    const SYNC_MANUAL = 4;


    /*
    |--------------------------------------------------------------------------
    | Connection Status
    |--------------------------------------------------------------------------
    */

    const STATUS_UNKNOWN = 1;
    const STATUS_ONLINE = 2;
    const STATUS_OFFLINE = 3;
    const STATUS_ERROR = 4;


    protected $fillable = [

        'school_id',
        'branch_id',

        'device_code',
        'device_name',
        'device_type',

        'serial_number',
        'vendor',
        'model',
        'firmware_version',

        'location_name',
        'location_description',

        'connection_type',

        'ip_address',
        'port',
        'username',
        'password',
        'api_url',
        'api_token',

        'timezone',

        'supports_fingerprint',
        'supports_face',
        'supports_rfid',
        'supports_palm',
        'supports_iris',

        'attendance_direction',

        'sync_mode',
        'sync_interval_seconds',

        'last_sync_at',
        'last_successful_sync_at',
        'last_sync_error',

        'connection_status',
        'last_seen_at',

        'is_active',
        'is_online',

        'installation_date',
        'warranty_expiry_date',

        'support_contact',
        'remarks',
    ];


    protected $casts = [

        'connection_type' => 'integer',

        'port' => 'integer',

        'supports_fingerprint' => 'boolean',
        'supports_face' => 'boolean',
        'supports_rfid' => 'boolean',
        'supports_palm' => 'boolean',
        'supports_iris' => 'boolean',

        'attendance_direction' => 'integer',

        'sync_mode' => 'integer',
        'sync_interval_seconds' => 'integer',

        'last_sync_at' => 'datetime',
        'last_successful_sync_at' => 'datetime',

        'connection_status' => 'integer',
        'last_seen_at' => 'datetime',

        'is_active' => 'boolean',
        'is_online' => 'boolean',

        'installation_date' => 'date',
        'warranty_expiry_date' => 'date',
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
        return $this->belongsTo(Branch::class);
    }

    public function employeeMappings()
    {
        return $this->hasMany(
            EmployeeAttendanceDevice::class,
            'device_id'
        );
    }
}