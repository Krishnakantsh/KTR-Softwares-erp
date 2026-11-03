<?php

namespace App\Models\FeeModule;

use App\Models\BaseModel;
use App\Models\FeeModule\FeeFineRule;
use App\Models\TransportMonth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeeFineRuleAmount extends BaseModel
{
      protected $table = 'fee_fine_rule_amounts';

      protected $primaryKey = 'id';

      protected $fillable = [
            'fee_fine_rule_id',
            'target_month_id',
            'fine_amount',
      ];

      public function rule(): BelongsTo
      {
            return $this->belongsTo(FeeFineRule::class, 'fee_fine_rule_id');
      }

      // The installment month this fine amount applies to (matrix column)
      public function targetMonth(): BelongsTo
      {
            return $this->belongsTo(TransportMonth::class, 'target_month_id');
      }
}
