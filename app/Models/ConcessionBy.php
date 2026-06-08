<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConcessionBy extends BaseModel
{
      use SoftDeletes;

      protected $table = "concession_bies";

      protected $primary_key = "id";

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
