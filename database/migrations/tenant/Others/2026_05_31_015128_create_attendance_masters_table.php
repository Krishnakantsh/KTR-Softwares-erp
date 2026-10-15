<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('attendance_masters', function (Blueprint $table) {
            $table->id();

            $table->foreignId('session_id')->nullable();

            $table->foreignId('class_id');
            $table->foreignId('section_id')->nullable();
            $table->foreignId('subject_id')->nullable();

            $table->date('attendance_date');

            $table->integer('period_no')->nullable();

            $table->unsignedBigInteger('teacher_id');


            $table->text('remarks')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique([
                'class_id',
                'section_id',
                'subject_id',
                'attendance_date',
                'period_no'
            ], 'attendance_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_masters');
    }
};
