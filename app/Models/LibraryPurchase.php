<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LibraryPurchase extends BaseModel
{
      use SoftDeletes;

      protected $table = 'library_purchases';

      protected $primaryKey = 'id';

      protected $fillable = [
            'school_id',
            'session_id',
            'supplier_id',
            'invoice_no',
            'invoice_date',
            'sub_total',
            'discount_amount',
            'gst_amount',
            'grand_total',
            'remarks',
            'status',
            'created_by',
            'updated_by',
      ];

      protected $casts = [
            'school_id'       => 'integer',
            'session_id'      => 'integer',
            'supplier_id'     => 'integer',
            'invoice_date'    => 'date',
            'sub_total'       => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'gst_amount'      => 'decimal:2',
            'grand_total'     => 'decimal:2',
            'status'          => 'boolean',
            'created_by'      => 'integer',
            'updated_by'      => 'integer',
      ];

      public function supplier(): BelongsTo
      {
            return $this->belongsTo(LibrarySupplier::class, 'supplier_id');
      }

      public function items(): HasMany
      {
            return $this->hasMany(LibraryPurchaseItem::class, 'purchase_id');
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
