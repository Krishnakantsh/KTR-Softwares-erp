<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LibraryPurchaseItem extends BaseModel
{
      protected $table = 'library_purchase_items';

      protected $primaryKey = 'id';

      protected $fillable = [
            'purchase_id',
            'book_id',
            'quantity',
            'rate',
            'amount',
      ];

      protected $casts = [
            'purchase_id' => 'integer',
            'book_id'     => 'integer',
            'quantity'    => 'integer',
            'rate'        => 'decimal:2',
            'amount'      => 'decimal:2',
      ];

      public function purchase(): BelongsTo
      {
            return $this->belongsTo(LibraryPurchase::class, 'purchase_id');
      }

      public function book(): BelongsTo
      {
            return $this->belongsTo(LibraryBook::class, 'book_id');
      }
}
