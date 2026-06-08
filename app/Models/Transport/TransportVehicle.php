<?php

namespace App\Models\Transport;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class TransportVehicle extends BaseModel
{
      use HasFactory, SoftDeletes;

      /*
    |--------------------------------------------------------------------------
    | TABLE NAME
    |--------------------------------------------------------------------------
    */

      protected $table = 'transport_vehicles';

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

            'vehicle_name',

            'vehicle_number',

            'vehicle_type',

            'driver_name',

            'driver_phone',

            'conductor_name',

            'conductor_phone',

            'seat_capacity',

            'insurance_number',

            'insurance_expiry',

            'pollution_number',

            'pollution_expiry',

            'fitness_certificate',

            'fitness_expiry',

            'rc_number',

            'monthly_maintenance_cost',

            'notes',

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

            'seat_capacity' => 'integer',

            'monthly_maintenance_cost' => 'decimal:2',

            'insurance_expiry' => 'date',

            'pollution_expiry' => 'date',

            'fitness_expiry' => 'date',

            'status' => 'boolean',

            'session_id' => 'integer',

            'school_id' => 'integer',
      ];

      /*
    |--------------------------------------------------------------------------
    | ASSIGNED ROUTES RELATION
    |--------------------------------------------------------------------------
    */

      public function assignedRoutes()
      {
            return $this->hasMany(
                  TransportAssignVehicle::class,
                  'transport_vehicle_id'
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
