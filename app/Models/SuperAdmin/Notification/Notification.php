<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'title',
        'body',
        'data',
        'target_type',
        'target_value',
        'status',
        'scheduled_at',
    ];

    protected $casts = [
        'data'         => 'array',
        'scheduled_at' => 'datetime',
    ];

    public function logs()
    {
        return $this->hasMany(NotificationLog::class);
    }

    public function getSentCountAttribute(): int
    {
        return $this->logs()->where('status', 'sent')->count();
    }

    public function getFailedCountAttribute(): int
    {
        return $this->logs()->where('status', 'failed')->count();
    }

    public function getOpenedCountAttribute(): int
    {
        return $this->logs()->whereNotNull('opened_at')->count();
    }

    public function getClickedCountAttribute(): int
    {
        return $this->logs()->whereNotNull('clicked_at')->count();
    }

    public function getOpenRateAttribute(): float
    {
        $sent = $this->sent_count;
        return $sent > 0 ? round(($this->opened_count / $sent) * 100, 2) : 0.0;
    }

    public function getClickRateAttribute(): float
    {
        $sent = $this->sent_count;
        return $sent > 0 ? round(($this->clicked_count / $sent) * 100, 2) : 0.0;
    }
}
