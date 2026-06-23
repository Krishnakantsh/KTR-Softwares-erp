<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LibraryBook extends BaseModel
{
      use HasFactory, SoftDeletes;

      protected $table = 'library_books';

      protected $primaryKey = 'id';

      protected $fillable = [
            'school_id',
            'session_id',
            'category_id',
            'author_id',
            'publication_id',
            'book_code',
            'slug',
            'accession_no',
            'barcode',
            'book_name',
            'sub_title',
            'isbn_no',
            'edition',
            'volume',
            'language',
            'rack_no',
            'shelf_no',
            'subject',
            'class_name',
            'publication_year',
            'pages',
            'quantity',
            'available_quantity',
            'issued_quantity',
            'damaged_quantity',
            'lost_quantity',
            'purchase_price',
            'selling_price',
            'description',
            'status',
            'created_by',
            'updated_by'
      ];

      protected $casts = [
            'school_id'          => 'integer',
            'session_id'         => 'integer',
            'category_id'        => 'integer',
            'author_id'          => 'integer',
            'publication_id'     => 'integer',
            'publication_year'   => 'integer',
            'pages'              => 'integer',
            'quantity'           => 'integer',
            'available_quantity' => 'integer',
            'issued_quantity'    => 'integer',
            'damaged_quantity'   => 'integer',
            'lost_quantity'      => 'integer',
            'purchase_price'     => 'decimal:2',
            'selling_price'      => 'decimal:2',
            'status'             => 'boolean',
            'created_by'         => 'integer',
            'updated_by'         => 'integer',
      ];

      public function category(): BelongsTo
      {
            return $this->belongsTo(LibraryCategory::class, 'category_id');
      }

      public function author(): BelongsTo
      {
            return $this->belongsTo(LibraryAuthor::class, 'author_id');
      }

      public function publication(): BelongsTo
      {
            return $this->belongsTo(LibraryPublication::class, 'publication_id');
      }

      public function school(): BelongsTo
      {
            return $this->belongsTo(School::class, 'school_id');
      }

      public function session(): BelongsTo
      {
            return $this->belongsTo(AcademicSession::class, 'session_id');
      }

      public function purchaseItems(): HasMany
      {
            return $this->hasMany(LibraryPurchaseItem::class, 'book_id');
      }

      public function issues(): HasMany
      {
            return $this->hasMany(LibraryIssue::class, 'book_id');
      }

      public function damages(): HasMany
      {
            return $this->hasMany(LibraryDamage::class, 'book_id');
      }

      public function stockLogs(): HasMany
      {
            return $this->hasMany(LibraryStockLog::class, 'book_id');
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
