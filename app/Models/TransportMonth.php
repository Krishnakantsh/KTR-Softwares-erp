<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransportMonth extends BaseModel
{
      use SoftDeletes;

      protected $table = 'transport_months';

      protected $primaryKey = 'id';

      protected $fillable = [
            'month_name',
            'slug',
            'transport_fee',
            'is_transport_enable',
            'status',
            'sort_order',
            'session_id'
      ];

      protected $casts = [
            'transport_fee' => 'boolean',
            'is_transport_enable' => 'boolean',
            'status' => 'boolean',
            'deleted_at' => 'datetime',
      ];
}
