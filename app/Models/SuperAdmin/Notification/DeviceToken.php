<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'device_type',
        'device_id',
        'is_active',
        'last_used_at',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'last_used_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Register (or refresh) a token for a user.
     * Same physical device logging in again just updates the row
     * instead of creating duplicates — but OTHER devices for the
     * same user are left untouched (multi-device support).
     */
    public static function registerForUser(int $userId, string $token, string $deviceType, ?string $deviceId = null): self
    {
        return self::updateOrCreate(
            ['token' => $token],
            [
                'user_id'      => $userId,
                'device_type'  => $deviceType,
                'device_id'    => $deviceId,
                'is_active'    => true,
                'last_used_at' => now(),
            ]
        );
    }

    /** Called on logout - deactivate just THIS device's token. */
    public static function deactivate(string $token): void
    {
        self::where('token', $token)->update(['is_active' => false]);
    }
}
