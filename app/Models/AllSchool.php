<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllSchool extends Model
{
    use SoftDeletes;

    protected $table = 'all_schools';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'username',
        'password',

        'db_name',
        'db_pass',
        'db_user',

        'plan_id',
        'school_id',

        'start_date',
        'valid_upto',
        'grace_period',

        'is_active',

        'email',
        'phone',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'date',
        'valid_upto' => 'date',
    ];
}
