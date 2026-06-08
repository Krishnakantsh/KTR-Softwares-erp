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
        Schema::create('student_previous_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('previous_school_name')->nullable();

            $table->string('previous_class_name')->nullable();

            $table->string('previous_passout_year')->nullable();

            $table->string('previous_registration_no')->nullable();

            $table->string('previous_roll_no')->nullable();

            $table->string('previous_board')->nullable();

            $table->text('previous_subjects')->nullable();

            $table->string('previous_result')->nullable();

            $table->string('previous_marks')->nullable();

            $table->string('previous_percentage')->nullable();

            $table->boolean('having_transfer_certificate')->default(false);

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_previous_details');
    }
};
