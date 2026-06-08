<?php

namespace App\Models\Transport;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class TransportDestination extends BaseModel
{
    use HasFactory, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | TABLE NAME
    |--------------------------------------------------------------------------
    */

    protected $table = 'transport_destinations';

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

        'transport_route_id',

        'destination_name',

        'pickup_time',

        'drop_time',

        'stop_order',

        'distance_from_school',

        'transport_fee',

        'address',

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

        'transport_route_id' => 'integer',

        'stop_order' => 'integer',

        'distance_from_school' => 'decimal:2',

        'transport_fee' => 'decimal:2',

        'status' => 'boolean',

        'session_id' => 'integer',

        'school_id' => 'integer',
    ];

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
    | ASSIGNED STUDENTS RELATION
    |--------------------------------------------------------------------------
    */

    public function assignedStudents()
    {
        return $this->hasMany(
            TransportAssignRoute::class,
            'transport_destination_id'
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