<?php

namespace App\Models\FeeModule;

use App\Models\AllSchool;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;


class FeeHead extends BaseModel
{
      use SoftDeletes;
      protected $fillable = [

            'school_id',

            'fee_group_id',

            'head_name',

            'head_code',

            'display_order',

            'description',

            'status'
      ];

      protected $casts = [

            'status' => 'boolean'
      ];

      public function school()
      {
            return $this->belongsTo(AllSchool::class);
      }

      public function group()
      {
            return $this->belongsTo(FeeGroup::class, 'fee_group_id');
      }

      public function applicability()
      {
            return $this->hasOne(FeeHeadApplicability::class);
      }
}
