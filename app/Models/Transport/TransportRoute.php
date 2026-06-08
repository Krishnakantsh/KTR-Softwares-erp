<?php

namespace App\Models\Transport;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class TransportRoute extends BaseModel
{
      use HasFactory, SoftDeletes;

      /*
    |--------------------------------------------------------------------------
    | TABLE NAME
    |--------------------------------------------------------------------------
    */

      protected $table = 'transport_routes';

      /*
    |--------------------------------------------------------------------------
    | PRIMARY KEY
    |--------------------------------------------------------------------------
    */

      protected $primaryKey = 'id';

      /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNABLE
    |--------------------------------------------------------------------------
    */

      protected $fillable = [

            'route_name',

            'route_code',

            'start_point',

            'end_point',

            'total_distance',

            'estimated_time',

            'route_description',

            'status',

            'session_id',

            'school_id',
      ];

      /*
    |--------------------------------------------------------------------------
    | TYPE CASTING
    |--------------------------------------------------------------------------
    */

      protected $casts = [

            'total_distance' => 'decimal:2',

            'estimated_time' => 'integer',

            'status' => 'boolean',

            'session_id' => 'integer',

            'school_id' => 'integer',
      ];

      /*
    |--------------------------------------------------------------------------
    | DESTINATIONS RELATION
    |--------------------------------------------------------------------------
    */

      public function destinations()
      {
            return $this->hasMany(
                  TransportDestination::class,
                  'transport_route_id'
            );
      }

      /*
    |--------------------------------------------------------------------------
    | ASSIGNED VEHICLES RELATION
    |--------------------------------------------------------------------------
    */

      public function assignedVehicles()
      {
            return $this->hasMany(
                  TransportAssignVehicle::class,
                  'transport_route_id'
            );
      }

      /*
    |--------------------------------------------------------------------------
    | ASSIGNED STUDENTS / ROUTES
    |--------------------------------------------------------------------------
    */

      public function assignedStudents()
      {
            return $this->hasMany(
                  TransportAssignRoute::class,
                  'transport_route_id'
            );
      }

      /*
    |--------------------------------------------------------------------------
    | ACTIVE SCOPE
    |--------------------------------------------------------------------------
    */

      public function scopeActive($query)
      {
            return $query->where('status', true);
      }

      /*
    |--------------------------------------------------------------------------
    | CURRENT SESSION SCOPE
    |--------------------------------------------------------------------------
    */

      public function scopeCurrentSession($query)
      {
            return $query->where(
                  'session_id',
                  activeSession()->id ?? null
            );
      }

      /*
    |--------------------------------------------------------------------------
    | CURRENT SCHOOL SCOPE
    |--------------------------------------------------------------------------
    */

      public function scopeCurrentSchool($query)
      {
            return $query->where(
                  'school_id',
                     Auth::id()
            );
      }
}
