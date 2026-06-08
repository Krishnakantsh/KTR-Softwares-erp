<?php

namespace App\Models\Student;

use App\Models\BaseModel;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentObjection extends BaseModel
{
    use SoftDeletes;

    protected $table = 'student_objections';

    protected $primaryKey = 'id';

    protected $fillable = [
        'student_id',
        'document_type',
        'file_name',
        'file_path',
        'status',
        'verified_by',
    ];

    protected $casts = [
        'student_id'  => 'integer',
        'verified_by' => 'integer',
        'status'      => 'boolean',
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

    /**
     * Verified By User Relation
     */
    public function verifiedBy()
    {
        return $this->belongsTo(
            User::class,
            'verified_by',
            'id'
        );
    }
}