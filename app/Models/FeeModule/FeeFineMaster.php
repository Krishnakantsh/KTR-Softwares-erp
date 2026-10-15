<?php

namespace App\Models\FeeModule;

use App\Models\BaseModel;


class FeeFineMaster extends BaseModel
{
   

      protected $fillable = [

            'school_id',

            'fine_name',

            'fine_code',

            'fine_type',

            'grace_days',

            'description',

            'status'
      ];
      const TYPE_FIXED = 1;
      const TYPE_PER_DAY = 2;
      const TYPE_MONTHLY = 3;
      const TYPE_WEEKLY = 4;
      const TYPE_HALF_YEARLY = 5;

      protected $casts = [

            'status' => 'boolean'
      ];

      public function rules()
      {
            return $this->hasMany(FeeFineRule::class);
      }
}
