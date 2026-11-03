<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('student_fee_assignments', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->unsignedBigInteger('session_id');

            $table->unsignedBigInteger('student_id');

            $table->unsignedBigInteger('fee_structure_id');

            $table->date('assigned_date');

            $table->text('remarks')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('session_id', 'sfa_session_fk')
                ->references('id')
                ->on('academic_sessions')
                ->cascadeOnDelete();

            $table->foreign('student_id', 'sfa_student_fk')
                ->references('id')
                ->on('students')
                ->cascadeOnDelete();

            $table->foreign('fee_structure_id', 'sfa_structure_fk')
                ->references('id')
                ->on('fee_structures')
                ->cascadeOnDelete();

            // One Fee Assignment per Student per Session
            $table->unique(
                ['school_id', 'session_id', 'student_id'],
                'uq_student_fee_assignment'
            );

            $table->index(
                ['school_id', 'session_id'],
                'idx_sfa_school_session'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_assignments');
    }
};
