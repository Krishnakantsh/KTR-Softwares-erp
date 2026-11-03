<?php

namespace App\Models\FeeModule;

use App\Models\AcademicSession;
use App\Models\BaseModel;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentFeeAssignment extends BaseModel
{
      use SoftDeletes;

      protected $table = 'student_fee_assignments';

      protected $primaryKey = 'id';

      protected $fillable = [
            'school_id',
            'session_id',
            'student_id',
            'fee_structure_id',
            'assigned_date',
            'remarks',
            'status',
      ];

      protected $casts = [
            'assigned_date' => 'date',
            'status' => 'boolean',
      ];

      /*
      |--------------------------------------------------------------------------
      | Relationships
      |--------------------------------------------------------------------------
      */

      public function details()
      {
            return $this->hasMany(
                  StudentFeeAssignmentDetail::class,
                  'student_fee_assignment_id'
            );
      }

      public function feeStructure()
      {
            return $this->belongsTo(
                  FeeStructure::class,
                  'fee_structure_id'
            );
      }

      public function student()
      {
            return $this->belongsTo(
                  Student::class,
                  'student_id'
            );
      }

      public function session()
      {
            return $this->belongsTo(
                  AcademicSession::class,
                  'session_id'
            );
      }
}
