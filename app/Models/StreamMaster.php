<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class StreamMaster extends BaseModel
{
      use SoftDeletes;

      protected $fillable = ['name', 'slug',  'session_id','status'];
}
