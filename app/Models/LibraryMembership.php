<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryMembership extends BaseModel
{
    use SoftDeletes;

    protected $table = 'library_memberships';

    protected $primaryKey = 'id';

    protected $fillable = [
        'membership_card_number',
        'barcode_token',
        'qr_code_payload',

        'student_id',
        'session_id',

        'activation_date',
        'expiry_date',
        'last_renewed_at',

        'max_borrow_limit',
        'borrow_duration_days',

        'security_deposit',
        'is_deposit_refundable',

        'status',
        'suspension_reason',

        'created_by_user_id',
        'admin_remarks',
    ];

    protected $casts = [
        'activation_date'         => 'date',
        'expiry_date'             => 'date',
        'last_renewed_at'         => 'date',

        'max_borrow_limit'        => 'integer',
        'borrow_duration_days'    => 'integer',

        'security_deposit'        => 'decimal:2',

        'is_deposit_refundable'   => 'boolean',
        'status'                  => 'integer',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }


    public function libraryBookBorrowHistory()
    {
        return $this->hasMany(LibraryIssue::class, 'member_id');
    }
}
