<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassMaster extends BaseModel
{
      use SoftDeletes;

      protected $table = 'class_masters';

      protected $fillable = [
            'name',
            'slug',
            'session_id',
            'status'
      ];


      protected $primary_key = "id";

      public function subjects()
      {
            return $this->belongsToMany(Subject::class, 'subject_links', 'class_id', 'subject_id')
                  ->withPivot('status')
                  ->withTimestamps();
      }

      public function classSections()
      {
            return $this->hasMany(ClassSection::class);
      }
}
