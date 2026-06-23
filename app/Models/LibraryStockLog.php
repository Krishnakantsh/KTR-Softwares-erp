<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryStockLog extends BaseModel
{
      use SoftDeletes;
      
      protected $table = 'library_stock_logs';

      protected $primaryKey = 'id';

      protected $fillable = [
            'school_id',
            'session_id',
            'book_id',
            'transaction_type',
            'quantity',
            'opening_stock',
            'closing_stock',
            'reference_type',
            'reference_id',
            'remarks',
            'created_by',
      ];

      protected $casts = [
            'school_id'       => 'integer',
            'session_id'      => 'integer',
            'book_id'         => 'integer',
            'quantity'        => 'integer',
            'opening_stock'   => 'integer',
            'closing_stock'   => 'integer',
            'reference_id'    => 'integer',
            'created_by'      => 'integer',
      ];

      public function book(): BelongsTo
      {
            return $this->belongsTo(LibraryBook::class, 'book_id');
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
}
