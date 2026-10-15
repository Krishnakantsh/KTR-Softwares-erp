<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledNotification extends Model
{
    protected $fillable = [
        'title',
        'body',
        'data',
        'target_type',
        'target_value',
        'scheduled_at',
        'timezone',
        'sent',
        'notification_id',
    ];

    protected $casts = [
        'data'         => 'array',
        'scheduled_at' => 'datetime',
        'sent'         => 'boolean',
    ];

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function scopeDue($query)
    {
        return $query->where('sent', false)->where('scheduled_at', '<=', now());
    }
}
