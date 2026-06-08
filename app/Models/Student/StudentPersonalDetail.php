<?php

namespace App\Models\Student;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentPersonalDetail extends BaseModel
{
      use SoftDeletes;

      protected $table = 'student_personal_details';

      protected $primaryKey = 'id';

      protected $fillable = [
            'student_id',
            'nationality',
            'religion',
            'category',
            'caste',
            'aadhaar_no',
            'email',
            'apaar_id',
            'passport_no',
            'nic',
            'bpl_card',
            'saral_id',
            'family_id',
            'blood_group',
            'height',
            'weight',
            'mother_tongue',
            'donation_amount',
      ];

      protected $casts = [
            'donation_amount' => 'decimal:2',
      ];

      public function student(): BelongsTo
      {
            return $this->belongsTo(Student::class, 'student_id');
      }
}
