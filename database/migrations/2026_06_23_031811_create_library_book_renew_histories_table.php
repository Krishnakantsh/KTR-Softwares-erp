<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('library_book_renew_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('library_book_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('old_due_date');
            $table->date('new_due_date');

            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('renewed_by')->nullable();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('library_book_renew_histories');
    }
};
