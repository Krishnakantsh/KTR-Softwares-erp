<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryBook extends BaseModel
{
      use HasFactory, SoftDeletes;

      protected $fillable = [
            'school_id',
            'session_id',
            'category_id',
            'author_id',
            'publication_id',
            'book_code',
            'book_name',
            'isbn_no',
            'edition',
            'volume',
            'language',
            'rack_no',
            'shelf_no',
            'quantity',
            'available_quantity',
            'purchase_price',
            'selling_price',
            'description',
            'status',
            'created_by',
            'updated_by'
      ];


      public function author()
      {
            return $this->belongsTo(LibraryAuthor::class);
      }

      public function publication()
      {
            return $this->belongsTo(LibraryPublication::class);
      }

      public function category()
      {
            return $this->belongsTo(LibraryCategory::class);
      }

      public function purchaseItems()
      {
            return $this->hasMany(LibraryPurchaseItem::class, 'book_id');
      }

      public function issues()
      {
            return $this->hasMany(LibraryIssue::class, 'book_id');
      }

      public function damages()
      {
            return $this->hasMany(LibraryDamage::class, 'book_id');
      }

      public function stockLogs()
      {
            return $this->hasMany(LibraryStockLog::class, 'book_id');
      }
}
