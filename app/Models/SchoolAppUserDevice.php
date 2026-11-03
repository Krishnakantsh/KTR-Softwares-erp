<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolAppUserDevice extends Model
{
    use SoftDeletes;

    protected $table = 'school_app_user_devices';

    protected $fillable = [
        'school_id',
        'school_app_user_id',
        'user_type',
        'device_token',
        'device_id',
        'device_name',
        'platform',
        'is_active',
        'last_login_at',
    ];

    protected $casts = [
        'school_id' => 'integer',
        'school_app_user_id' => 'integer',
        'user_type' => 'integer',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

    public function school()
    {
        return $this->belongsTo(AllSchool::class, 'school_id');
    }

    public function schoolAppUser()
    {
        return $this->belongsTo(SchoolAppUser::class, 'school_app_user_id');
    }
}