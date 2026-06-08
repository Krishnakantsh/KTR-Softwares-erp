<?php

namespace App\Models;

use App\Models\Hostel_System\Hostel;
use App\Models\Hostel_System\HostelBlock;
use App\Models\Hostel_System\HostelFloor;
use App\Models\Hostel_System\RoomMaster;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManageStudentHostel extends BaseModel
{
      use SoftDeletes;

      protected $table = 'manage_student_hostels';

      protected $primaryKey = 'id';

      protected $fillable = [

            'student_id',

            'hostel_id',
            'block_id',
            'floor_id',
            'room_id',

            'apply_date',

            'status',
            'remarks',

            'session_id',
            'created_by',
            'updated_by',
      ];

      protected $casts = [

            'student_id' => 'integer',

            'hostel_id' => 'integer',
            'block_id' => 'integer',
            'floor_id' => 'integer',
            'room_id' => 'integer',

            'session_id' => 'integer',

            'status' => 'boolean',

            'apply_date' => 'date',
      ];


      public function student()
      {
            return $this->belongsTo(Student::class);
      }

      public function hostel()
      {
            return $this->belongsTo(Hostel::class, 'hostel_id');
      }

      public function block()
      {
            return $this->belongsTo(HostelBlock::class, 'block_id');
      }

      public function floor()
      {
            return $this->belongsTo(HostelFloor::class, 'floor_id');
      }

      public function room()
      {
            return $this->belongsTo(RoomMaster::class, 'room_id');
      }
}
