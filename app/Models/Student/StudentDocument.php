<?php

namespace App\Models\Student;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDocument extends BaseModel
{
      use SoftDeletes;

      protected $table = 'student_documents';

      protected $primaryKey = 'id';

      protected $fillable = [
            'student_id',
            'document_name',
            'document_file',
            'remark',
            'created_by',
            'session_id',
      ];

      protected $casts = [
            'student_id' => 'integer',
            'created_by' => 'integer',
            'session_id' => 'integer',
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
