<?php

namespace App\Models\FeeModule;

use App\Models\AllSchool;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class FeeGroup extends BaseModel
{
         use SoftDeletes;
      protected $fillable = [
            'school_id',
            'group_name',
            'group_code',
            'description',
            'status',
      ];

      protected $casts = [
            'status' => 'boolean',
      ];

      public function school()
      {
            return $this->belongsTo(AllSchool::class);
      }

      public function feeHeads()
      {
            return $this->hasMany(FeeHead::class);
      }
}
