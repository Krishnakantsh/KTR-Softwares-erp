<?php

namespace App\Models;


use App\Models\Transport\TransportDestination;
use App\Models\Student\Student;
use App\Models\Transport\TransportRoute;
use App\Models\Transport\TransportVehicle;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManageStudentTransport extends BaseModel
{
      use SoftDeletes;

      protected $table = 'student_transports';

      protected $fillable = [
            'session_id',
            'student_id',
            'route_id',
            'vehicle_id',
            'destination_id',
            'apply_date',
            'status',
            'remarks',
            'created_by',
            'updated_by',
      ];

      protected $casts = [
            'status' => 'boolean',
            'apply_date' => 'date',
      ];

      public function student(){
            return $this->belongsTo(Student::class, 'student_id');
      }

      public function route()
      {
            return $this->belongsTo(TransportRoute::class);
      }

      public function vehicle()
      {
            return $this->belongsTo(TransportVehicle::class);
      }

      public function destination()
      {
            return $this->belongsTo(TransportDestination::class);
      }
}
