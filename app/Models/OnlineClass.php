<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Student\Student;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OnlineClass extends BaseModel
{
    use SoftDeletes;

    protected $table = 'online_classes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'class_id',
        'section_id',
        'subject_id',
        'stream_id',
        'session_id',
        'created_by',
        'teacher_id',
        'platform',
        'title',
        'description',
        'meeting_link',
        'meeting_id',
        'password',
        'held_date',
        'held_time',
        'duration',
        'status',
    ];

    protected $casts = [
        'held_date' => 'date',
        'held_time' => 'datetime:H:i',
        'duration'  => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function class(): BelongsTo
    {
        return $this->belongsTo(ClassMaster::class, 'class_id');
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(ClassSection::class, 'section_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }



    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getPlatformLabelAttribute(): string
    {
        return match ($this->platform) {
            'google_meet'     => 'Google Meet',
            'zoom'            => 'Zoom',
            'microsoft_teams' => 'Microsoft Teams',
            default           => 'Other',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return ucfirst($this->status);
    }
}