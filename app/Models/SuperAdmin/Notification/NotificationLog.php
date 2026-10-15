<?php

namespace App\Models\SuperAdmin\Notification;

use App\Models\AllSchool;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationLog extends BaseModel
{
      use SoftDeletes;

      protected $fillable = [

            'tenant_id',

            'notification_template_id',

            'channel',

            'notification_type',

            'recipient',

            'subject',

            'message',

            'status',

            'provider',

            'provider_message_id',

            'provider_response',

            'failure_reason',

            'queued_at',

            'sent_at',

            'delivered_at',

            'read_at',

            'metadata'
      ];

      protected $casts = [

            'provider_response' => 'array',

            'metadata' => 'array',

            'queued_at' => 'datetime',

            'sent_at' => 'datetime',

            'delivered_at' => 'datetime',

            'read_at' => 'datetime'
      ];

      public function tenant()
      {
            return $this->belongsTo(
                  AllSchool::class
            );
      }

      public function template()
      {
            return $this->belongsTo(
                  NotificationTemplate::class,
                  'notification_template_id'
            );
      }
}
