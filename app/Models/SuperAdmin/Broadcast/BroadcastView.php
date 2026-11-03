<?php

namespace App\Models\SuperAdmin\Broadcast;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BroadcastView extends Model
{
      use SoftDeletes;

      protected $table = 'broadcast_views';

      protected $primaryKey = 'id';

      protected $fillable = [

            'broadcast_id',

            'tenant_id',
            'user_id',

            'platform',

            'device',
            'ip_address',

            'seen_at',
            'clicked_at',
            'dismissed_at',
            'acknowledged_at',
      ];

      protected $casts = [

            'seen_at' => 'datetime',
            'clicked_at' => 'datetime',
            'dismissed_at' => 'datetime',
            'acknowledged_at' => 'datetime',
      ];

      // broadcast
      public function broadcast(): BelongsTo
      {
            return $this->belongsTo(Broadcast::class);
      }
}
