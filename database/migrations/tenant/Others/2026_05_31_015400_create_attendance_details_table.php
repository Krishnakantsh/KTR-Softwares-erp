<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('attendance_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('attendance_master_id')
                ->constrained('attendance_masters')
                ->cascadeOnDelete();

            $table->foreignId('student_id');

            $table->enum('attendance_status', [
                'P',
                'A',
                'L',
                'H'
            ])->default('P');

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->unique(
                [
                    'attendance_master_id',
                    'student_id'
                ],
                'attendance_student_unique'
            );
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('attendance_details');
    }
};
