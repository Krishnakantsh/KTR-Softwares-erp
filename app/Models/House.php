<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends BaseModel
{
      use SoftDeletes;

      protected $table = 'houses';

      protected $primaryKey = 'id';

      protected $fillable = [
            'name',
            'slug',
            'status',
            'session_id',
      ];

      protected $casts = [
            'status' => 'boolean',
            'session_id' => 'integer',
            'deleted_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
      ];
}
