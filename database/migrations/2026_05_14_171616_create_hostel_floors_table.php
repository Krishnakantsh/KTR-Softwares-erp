<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hostel_floors', function (Blueprint $table) {

            $table->id();

            $table->foreignId('hostel_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('hostel_block_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('floor_name');

            $table->integer('floor_number')->default(1);

            $table->integer('total_rooms')->default(0);

            $table->text('remarks')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('session_id')->nullable();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hostel_floors');
    }
};
