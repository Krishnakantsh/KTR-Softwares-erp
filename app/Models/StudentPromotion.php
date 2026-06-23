<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Student\Student;

class StudentPromotion extends BaseModel
{


      protected $table = 'student_promotions';

      protected $primaryKey = 'id';

      protected $fillable = [

            'student_id',

            'from_session_id',
            'from_class_id',
            'from_section_id',

            'to_session_id',
            'to_class_id',
            'to_section_id',

            'promotion_date',

            'promoted_by',

            'remarks',
      ];

      protected $casts = [

            'student_id'       => 'integer',

            'from_session_id'  => 'integer',
            'from_class_id'    => 'integer',
            'from_section_id'  => 'integer',

            'to_session_id'    => 'integer',
            'to_class_id'      => 'integer',
            'to_section_id'    => 'integer',

            'promotion_date'   => 'date',

            'promoted_by'      => 'integer',
      ];

      public function student()
      {
            return $this->belongsTo(Student::class);
      }
}
