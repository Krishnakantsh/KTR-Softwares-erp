<?php

namespace App\Models\SuperAdmin\Broadcast;

use App\Models\School;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Broadcast extends Model
{
      use SoftDeletes;

      protected $table = 'broadcasts';

      protected $primaryKey = 'id';

      protected $fillable = [

            'uuid',
            'title',
            'slug',
            'description',
            'image',
            'icon',
            'type',
            'priority',
            'audience_type',
            'tenant_json',
            'module_name',
            'module_url',
            'button_text',
            'button_url',
            'platform',
            'display_type',
            'popup_position',
            'action_type',
            'banner_color',
            'current_version',
            'min_version',
            'max_version',
            'show_popup',
            'show_notification',
            'is_dismissible',
            'requires_acknowledgement',
            'repeat_type',
            'display_order',
            'start_date',
            'end_date',
            'start_time',
            'end_time',
            'attachment',
            'status',
            'created_by',
            'updated_by',
      ];

      protected $casts = [

            'tenant_json' => 'array',
            'platform' => 'array',

            'show_popup' => 'boolean',
            'show_notification' => 'boolean',
            'is_dismissible' => 'boolean',
            'requires_acknowledgement' => 'boolean',

            'start_date' => 'date',
            'end_date' => 'date',

            'start_time' => 'datetime:H:i',
            'end_time' => 'datetime:H:i',
      ];

      public function views(): HasMany
      {
            return $this->hasMany(BroadcastView::class);
      }

      public function tenant(): BelongsTo
      {
            return $this->belongsTo(School::class);
      }

      public function user(): BelongsTo
      {
            return $this->belongsTo(User::class);
      }
}
