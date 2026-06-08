<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademicSession extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'name',
            'start_year',
            'end_year',
            'start_date',
            'end_date',
            'slug',
            'status',
            'is_active'
      ];
}
