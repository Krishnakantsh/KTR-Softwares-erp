<?php

namespace App\Models\Hostel_System;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoomMaster extends BaseModel
{
      use SoftDeletes;

      protected $guarded = [];

      public function hostel()
      {
            return $this->belongsTo(Hostel::class);
      }

      public function block()
      {
            return $this->belongsTo(HostelBlock::class, 'hostel_block_id');
      }

      public function floor()
      {
            return $this->belongsTo(HostelFloor::class, 'hostel_floor_id');
      }

      public function roomType()
      {
            return $this->belongsTo(RoomType::class);
      }
}
