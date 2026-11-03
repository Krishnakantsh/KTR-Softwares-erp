<?php

namespace App\Models\FeeModule;

use App\Models\AcademicSession;
use App\Models\AllSchool;
use App\Models\BaseModel;
use App\Models\ClassMaster;
use App\Models\StreamMaster;
use Illuminate\Database\Eloquent\SoftDeletes;


class FeeStructure extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [

            'school_id',
            'session_id',
            'class_id',
            'stream_id',

            'structure_name',

            'effective_from',
            'effective_to',

            'remarks',

            'status'
      ];

      protected $casts = [

            'effective_from' => 'date',

            'effective_to' => 'date',

            'status' => 'boolean'
      ];

      public function details()
      {
            return $this->hasMany(FeeStructureDetail::class);
      }

      public function school()
      {
            return $this->belongsTo(AllSchool::class);
      }

      public function session()
      {
            return $this->belongsTo(AcademicSession::class);
      }

      public function class()
      {
            return $this->belongsTo(ClassMaster::class);
      }

      public function stream()
      {
            return $this->belongsTo(StreamMaster::class);
      }
}
