<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttendanceMaster extends BaseModel
{
      use SoftDeletes;

      protected $table = 'attendance_masters';

      protected $primaryKey = 'id';

      protected $fillable = [
            'session_id',
            'branch_id',
            'class_id',
            'section_id',
            'subject_id',
            'teacher_id',
            'attendance_date',
            'period_no',
            'remarks',
      ];

      protected $casts = [
            'attendance_date' => 'date',
            'period_no'       => 'integer',
            'session_id'      => 'integer',
            'branch_id'       => 'integer',
            'class_id'        => 'integer',
            'section_id'      => 'integer',
            'subject_id'      => 'integer',
            'teacher_id'      => 'integer',
      ];

      /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

      public function details()
      {
            return $this->hasMany(
                  AttendanceDetail::class,
                  'attendance_master_id',
                  'id'
            );
      }

      public function session()
      {
            return $this->belongsTo(
                  AcademicSession::class,
                  'session_id',
                  'id'
            );
      }



      public function class()
      {
            return $this->belongsTo(
                  ClassMaster::class,
                  'class_id',
                  'id'
            );
      }

      public function section()
      {
            return $this->belongsTo(
                  ClassSection::class,
                  'section_id',
                  'id'
            );
      }

      public function subject()
      {
            return $this->belongsTo(
                  Subject::class,
                  'subject_id',
                  'id'
            );
      }

      //     public function teacher()
      //     {
      //         return $this->belongsTo(
      //             Teacher::class,
      //             'teacher_id',
      //             'id'
      //         );
      //     }
}
