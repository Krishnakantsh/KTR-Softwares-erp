<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassSection extends BaseModel
{
      use SoftDeletes;


      protected $fillable = [
            'name',
            'session_id',
            'slug',
            'status',
            'class_master_id'
      ];

      public function classMaster()
      {
            return $this->belongsTo(ClassMaster::class);
      }
}
