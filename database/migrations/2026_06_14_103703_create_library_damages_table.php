<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('library_damages', function (Blueprint $table) {

            $table->id();

              $table->unsignedBigInteger('school_id')->nullable();
            $table->unsignedBigInteger('session_id');

            $table->foreignId('book_id');

            $table->integer('quantity');

            $table->date('damage_date');

            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_damages');
    }
};
