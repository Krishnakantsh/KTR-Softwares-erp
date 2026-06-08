<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubjectLink extends BaseModel
{
      use SoftDeletes;


      protected $fillable = ['class_id',  'session_id', 'subject_id', 'status'];


      public function class()
      {
            return $this->belongsTo(ClassMaster::class, 'class_id');
      }

      public function subject()
      {
            return $this->belongsTo(Subject::class, 'subject_id');
      }
}
