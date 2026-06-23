<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LibrarySupplier extends BaseModel
{
    use SoftDeletes;

    protected $table = 'library_suppliers';

    protected $primaryKey = 'id';

    protected $fillable = [
        'school_id',
        'session_id',
        'supplier_name',
        'contact_person',
        'mobile',
        'alternate_mobile',
        'email',
        'gst_number',
        'address',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'school_id'  => 'integer',
        'session_id' => 'integer',
        'status'     => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function purchases(): HasMany
    {
        return $this->hasMany(LibraryPurchase::class, 'supplier_id');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}