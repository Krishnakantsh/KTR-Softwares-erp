<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('library_purchase_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('purchase_id');

            $table->foreignId('book_id');

            $table->integer('quantity');

            $table->decimal('rate', 10, 2);

            $table->decimal('amount', 12, 2);

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('library_purchase_items');
    }
};
