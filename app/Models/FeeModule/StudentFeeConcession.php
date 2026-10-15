<?php

namespace App\Models\FeeModule;

use App\Models\BaseModel;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentFeeConcession extends BaseModel
{
    use SoftDeletes;

    protected $table = 'student_fee_concessions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'school_id',
        'session_id',
        'student_id',
        'student_fee_assignment_detail_id',
        'concession_type_id',
        'concession_by_id',
        'concession_mode',
        'concession_value',
        'description',
        'status',
    ];

    protected $casts = [
        'concession_value' => 'decimal:2',
        'status'           => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }

    public function assignmentDetail()
    {
        return $this->belongsTo(
            StudentFeeAssignmentDetail::class,
            'student_fee_assignment_detail_id'
        );
    }

    public function concessionType()
    {
        return $this->belongsTo(
            \App\Models\ConcessionType::class,
            'concession_type_id'
        );
    }

    public function concessionBy()
    {
        return $this->belongsTo(
            \App\Models\ConcessionBy::class,
            'concession_by_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Relations
    |--------------------------------------------------------------------------
    */

    public function feeHead()
    {
        return $this->hasOneThrough(
            FeeHead::class,
            StudentFeeAssignmentDetail::class,
            'id',                                 // student_fee_assignment_details.id
            'id',                                 // fee_heads.id
            'student_fee_assignment_detail_id',   // student_fee_concessions.student_fee_assignment_detail_id
            'fee_head_id'                         // student_fee_assignment_details.fee_head_id
        );
    }

    public function installment()
    {
        return $this->hasOneThrough(
            FeeInstallmentDetail::class,
            StudentFeeAssignmentDetail::class,
            'id',
            'id',
            'student_fee_assignment_detail_id',
            'fee_installment_detail_id'
        );
    }
}