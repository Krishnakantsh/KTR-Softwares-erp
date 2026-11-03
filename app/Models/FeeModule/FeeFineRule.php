<?php

namespace App\Models\FeeModule;

use App\Models\BaseModel;

class FeeFineRule extends BaseModel
{


      protected $fillable = [

            'fee_fine_master_id',

            'from_day',

            'to_day',

            'fine_amount',

            'display_order',

            'status',
            
            'transport_month_id'
      ];

      protected $casts = [

            'fine_amount' => 'decimal:2',

            'status' => 'boolean'
      ];

      public function master()
      {
            return $this->belongsTo(FeeFineMaster::class);
      }

      public function amounts()
      {
            return $this->hasMany(FeeFineRuleAmount::class, 'fee_fine_rule_id');
      }
}
