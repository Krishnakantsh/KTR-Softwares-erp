<?php

namespace App\Models\FeeModule;

use App\Models\AcademicSession;
use App\Models\AllSchool;
use App\Models\BaseModel;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeeCollection extends BaseModel
{
        
           
      protected $fillable = [

            'school_id',
            'session_id',

            'student_id',

            'receipt_no',

            'receipt_date',

            'payment_mode',

            'transaction_no',

            'bank_name',

            'total_amount',

            'total_concession',

            'total_fine',

            'net_amount',

            'remarks',

            'received_by',

            'status',
            
            'receipt_status'
      ];

      protected $casts = [

            'receipt_date' => 'date',

            'total_amount' => 'decimal:2',

            'total_concession' => 'decimal:2',

            'total_fine' => 'decimal:2',

            'net_amount' => 'decimal:2',

            'status' => 'boolean'
      ];

      public function details()
      {
            return $this->hasMany(FeeCollectionDetail::class);
      }

      public function student()
      {
            return $this->belongsTo(Student::class);
      }

      public function school()
      {
            return $this->belongsTo(AllSchool::class);
      }

      public function session()
      {
            return $this->belongsTo(AcademicSession::class);
      }
}
