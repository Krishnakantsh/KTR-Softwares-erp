<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class JustTest1 extends BaseModel
{
       use SoftDeletes;

      protected $table = [];

      protected $fillable = [];

      protected $primary_key= "";

      protected $casts = [];
}
