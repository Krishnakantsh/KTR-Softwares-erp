<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LibraryFine extends BaseModel
{
    use HasFactory, SoftDeletes;

    protected $table = 'library_fines';

    protected $primaryKey = 'id';

    protected $fillable = [
        'school_id',
        'session_id',
        'fine_amount',
        'fine_duration',
        'duration_type',
        'gst_percentage',
        'remarks',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'school_id'      => 'integer',
        'session_id'     => 'integer',
        'fine_amount'    => 'decimal:2',
        'fine_duration'  => 'integer',
        'gst_percentage' => 'decimal:2',
        'status'         => 'boolean',
        'created_by'     => 'integer',
        'updated_by'     => 'integer',
    ];

    // school

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    // session

    public function session(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }

    // created by

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // updated by

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // accessor

    public function getDurationTextAttribute(): string
    {
        return $this->fine_duration . ' ' . ucfirst($this->duration_type);
    }
}