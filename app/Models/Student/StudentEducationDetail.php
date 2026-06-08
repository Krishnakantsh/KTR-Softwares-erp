<?php

namespace App\Models\Student;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentEducationDetail extends BaseModel
{
      use SoftDeletes;

      protected $table = 'student_education_details';

      protected $primaryKey = 'id';

      protected $fillable = [
            'student_id',
            'course',
            'roll_no',
            'passing_year',
            'board_name',
            'marks',
            'obtain',
            'percentage',
      ];

      protected $casts = [
            'student_id' => 'integer',
      ];

 
      public function student()
      {
            return $this->belongsTo(
                  Student::class,
                  'student_id',
                  'id'
            );
      }
}
