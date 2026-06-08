<?php

namespace App\Models\Transport;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class TransportAssignVehicle extends BaseModel
{
    use HasFactory, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | TABLE NAME
    |--------------------------------------------------------------------------
    */

    protected $table = 'transport_assign_vehicles';

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

        'transport_vehicle_id',

        'transport_route_id',

        'shift',

        'assign_date',

        'remarks',

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

        'transport_vehicle_id' => 'integer',

        'transport_route_id' => 'integer',

        'assign_date' => 'date',

        'status' => 'boolean',

        'session_id' => 'integer',

        'school_id' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | VEHICLE RELATION
    |--------------------------------------------------------------------------
    */

    public function vehicle()
    {
        return $this->belongsTo(
            TransportVehicle::class,
            'transport_vehicle_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | ROUTE RELATION
    |--------------------------------------------------------------------------
    */

    public function route()
    {
        return $this->belongsTo(
            TransportRoute::class,
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