<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hostel_blocks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('hostel_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('block_name');

            $table->string('block_code')->nullable();

            $table->integer('total_floors')->default(0);

            $table->integer('capacity')->default(0);

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
        Schema::dropIfExists('hostel_blocks');
    }
};