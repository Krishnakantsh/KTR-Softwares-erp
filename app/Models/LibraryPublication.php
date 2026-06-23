<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LibraryPublication extends BaseModel
{
      use SoftDeletes;

      protected $table = 'library_publications';

      protected $primaryKey = 'id';

      protected $fillable = [
            'school_id',
            'session_id',
            'publication_name',
            'description',
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

      public function books(): HasMany
      {
            return $this->hasMany(LibraryBook::class, 'publication_id');
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
