<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApprovalFlow extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [
            'module',
            'level',
            'role',
            'status'
      ];
}
