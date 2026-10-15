<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('library_stock_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('school_id')->nullable();
            $table->unsignedBigInteger('session_id');

            $table->foreignId('book_id');

            $table->enum('transaction_type', [
                'purchase',
                'issue',
                'return',
                'damage',
                'lost',
                'manual'
            ]);

            $table->integer('quantity');

            $table->integer('opening_stock');

            $table->integer('closing_stock');

            $table->string('reference_type');

            $table->unsignedBigInteger('reference_id');

            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_stock_logs');
    }
};
