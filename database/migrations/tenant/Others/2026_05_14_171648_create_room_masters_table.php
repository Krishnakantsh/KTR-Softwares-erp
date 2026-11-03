<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
      public function up(): void
      {
            Schema::create('room_masters', function (Blueprint $table) {

                  $table->id();

                  $table->foreignId('hostel_id')
                        ->constrained()
                        ->cascadeOnDelete();

                  $table->foreignId('hostel_block_id')
                        ->constrained()
                        ->cascadeOnDelete();

                  $table->foreignId('hostel_floor_id')
                        ->constrained()
                        ->cascadeOnDelete();

                  $table->foreignId('room_type_id')
                        ->constrained()
                        ->cascadeOnDelete();

                  $table->string('room_number');

                  $table->integer('total_beds')->default(1);

                  $table->integer('occupied_beds')->default(0);

                  $table->integer('available_beds')->default(1);

                  $table->text('facilities')->nullable();

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
            Schema::dropIfExists('room_masters');
      }
};
