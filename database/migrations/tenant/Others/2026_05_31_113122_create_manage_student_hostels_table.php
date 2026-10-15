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
        Schema::create('manage_student_hostels', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->unsignedBigInteger('hostel_id');
            $table->unsignedBigInteger('block_id');
            $table->unsignedBigInteger('floor_id');
            $table->unsignedBigInteger('room_id');

            $table->date('apply_date')->nullable();

            $table->boolean('status')->default(true);

            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unique('student_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_student_hostels');
    }
};
