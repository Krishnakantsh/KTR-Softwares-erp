<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\SuperAdmin\SubscriptionPlan\SubscriptionPlan;

class Software extends BaseModel
{

      protected $guarded = [];

      protected $connection = 'mysql';

      protected $table = 'softwares';

      public function plan()
      {
            return $this->hasMany(SubscriptionPlan::class);
      }
}
