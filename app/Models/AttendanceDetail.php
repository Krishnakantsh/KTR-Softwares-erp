<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Student\Student;

class AttendanceDetail extends BaseModel
{


      protected $table = 'attendance_details';

      protected $primaryKey = 'id';

      protected $fillable = [
            'attendance_master_id',
            'student_id',
            'attendance_status',
            'remarks',
      ];

      protected $casts = [
            'attendance_master_id' => 'integer',
            'student_id'           => 'integer',
      ];

      public function attendanceMaster()
      {
            return $this->belongsTo(
                  AttendanceMaster::class,
                  'attendance_master_id',
                  'id'
            );
      }

      public function student()
      {
            return $this->belongsTo(
                  Student::class,
                  'student_id',
                  'id'
            );
      }
}
