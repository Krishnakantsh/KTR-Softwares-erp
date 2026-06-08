<?php

namespace App\Models\Student;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentParent extends BaseModel
{
    use SoftDeletes;

    protected $table = 'student_parents';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'parent_type',

        // Basic Info
        'name',
        'dob',
        'phone',
        'email',
        'aadhaar_no',
        'pan_no',
        'occupation',
        'designation',
        'qualification',
        'department',
        'annual_income',
        'address',
        'bpl_card',

        // Service Details
        'is_in_service',

        // Alive Status
        'is_alive',

        // Business Details
        'business_detail',
        'company_name',
        'office_phone',
        'office_email',
        'office_website',
        'office_address',

        'samagra_id',
        'remark',
        'status',
    ];

    protected $casts = [
        'student_id'      => 'integer',
        'annual_income'   => 'decimal:2',
        'is_in_service'   => 'boolean',
        'is_alive'        => 'boolean',
        'status'          => 'boolean',
        'dob'             => 'date',
    ];

    /**
     * Student Relation
     */
    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id',
            'id'
        );
    }
}