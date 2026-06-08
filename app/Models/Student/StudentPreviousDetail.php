<?php

namespace App\Models\Student;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentPreviousDetail extends BaseModel
{
      use SoftDeletes;

      protected $table = 'student_previous_details';

      protected $primaryKey = 'id';

      protected $fillable = [
            'student_id',
            'previous_school_name',
            'previous_class_name',
            'previous_passout_year',
            'previous_registration_no',
            'previous_roll_no',
            'previous_board',
            'previous_subjects',
            'previous_result',
            'previous_marks',
            'previous_percentage',
            'having_transfer_certificate',
      ];

      protected $casts = [
            'having_transfer_certificate' => 'boolean',
      ];

      public function student(): BelongsTo
      {
            return $this->belongsTo(Student::class, 'student_id');
      }
}
