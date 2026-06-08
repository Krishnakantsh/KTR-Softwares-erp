<?php

namespace App\Models\Student;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentBankDetail extends BaseModel
{
    use SoftDeletes;

    protected $table = 'student_bank_details';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'bank_name',
        'account_no',
        'account_holder_name',
        'ifsc_code',
    ];

    protected $casts = [];

    public function student()
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }
}