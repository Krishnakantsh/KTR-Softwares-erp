<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuperAdmin extends Model
{
      use SoftDeletes;

      protected $table = [];

      protected $fillable = [];

      protected $primary_key = "";

      protected $casts = [];
}
