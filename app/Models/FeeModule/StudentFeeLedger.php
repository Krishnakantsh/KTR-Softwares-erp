<?php

namespace App\Models\FeeModule;

use App\Models\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentFeeLedger extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'school_id',
        'session_id',
        'student_id',
        'fee_structure_id',
        'fee_head_id',
        'fee_installment_detail_id',
        'amount',
        'concession_amount',
        'fine_amount',
        'paid_amount',
        'balance_amount',
        'payment_status',
        'due_date',
        'paid_date',
        'status',
    ];

    protected $casts = [
        'due_date'   => 'date',
        'paid_date'  => 'date',
        'status'     => 'boolean',
        'amount'     => 'decimal:2',
        'concession_amount' => 'decimal:2',
        'fine_amount'       => 'decimal:2',
        'paid_amount'       => 'decimal:2',
        'balance_amount'    => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | payment_status constants (matches migration comment)
    |--------------------------------------------------------------------------
    */
    public const STATUS_PENDING   = 0;
    public const STATUS_PARTIAL   = 1;
    public const STATUS_PAID      = 2;
    public const STATUS_CANCELLED = 3;

    // NOTE: adjust namespaces below if your actual models live elsewhere —
    // these follow the same App\Models\FeeModule\* pattern used by
    // FeeStructure in StudentFeeAssignmentController.

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeHead()
    {
        return $this->belongsTo(FeeHead::class);
    }

    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class);
    }

    public function installment()
    {
        return $this->belongsTo(FeeInstallmentDetail::class, 'fee_installment_detail_id');
    }

    // NOTE: There is no direct FK from this table back to
    // student_fee_assignment_details (see StudentFeeAssignmentController
    // comments) — the link is resolved manually where needed via the
    // composite match (session_id, student_id, fee_head_id,
    // fee_installment_detail_id). See FeeCollectionController::calculateConcession().
}