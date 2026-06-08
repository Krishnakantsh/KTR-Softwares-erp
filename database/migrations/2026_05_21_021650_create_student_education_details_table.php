<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('student_education_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('course')->nullable();

            $table->string('roll_no')->nullable();

            $table->string('passing_year')->nullable();

            $table->string('board_name')->nullable();

            $table->string('marks')->nullable();

            $table->string('obtain')->nullable();

            $table->string('percentage')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('student_education_details');
    }
};
