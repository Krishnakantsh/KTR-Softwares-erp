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
        Schema::create('voucher_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('prefix');

            $table->integer('next_number')->default(1);

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('session_id')->nullable();
            
            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_types');
    }
};
