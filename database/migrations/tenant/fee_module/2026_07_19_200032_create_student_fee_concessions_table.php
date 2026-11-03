<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_concessions', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->unsignedBigInteger('session_id');

            $table->unsignedBigInteger('student_id');

            /*
            |--------------------------------------------------------------------------
            | Assignment Detail
            |--------------------------------------------------------------------------
            | Isse Head + Installment dono identify ho jayenge.
            */
            $table->unsignedBigInteger('student_fee_assignment_detail_id');

            /*
            |--------------------------------------------------------------------------
            | Concession Type
            |--------------------------------------------------------------------------
            | Sibling, Handicap, Staff Child, Third Child etc.
            */
            $table->unsignedBigInteger('concession_type_id');

            /*
            |--------------------------------------------------------------------------
            | Concession Approved By
            |--------------------------------------------------------------------------
            */
            $table->unsignedBigInteger('concession_by_id');

            /*
            |--------------------------------------------------------------------------
            | Concession Mode
            |--------------------------------------------------------------------------
            | 1 = Amount
            | 2 = Percentage
            */
            $table->tinyInteger('concession_mode')->default(1);

            $table->decimal('concession_value', 10, 2)->default(0);

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Foreign Keys
            |--------------------------------------------------------------------------
            */

            $table->foreign('session_id', 'sfc_ses_fk')
                ->references('id')
                ->on('academic_sessions')
                ->cascadeOnDelete();

            $table->foreign('student_id', 'sfc_std_fk')
                ->references('id')
                ->on('students')
                ->cascadeOnDelete();

            $table->foreign('student_fee_assignment_detail_id', 'sfc_sfad_fk')
                ->references('id')
                ->on('student_fee_assignment_details')
                ->cascadeOnDelete();

            $table->foreign('concession_type_id', 'sfc_ctype_fk')
                ->references('id')
                ->on('concession_types')
                ->cascadeOnDelete();

            $table->foreign('concession_by_id', 'sfc_cby_fk')
                ->references('id')
                ->on('concession_bies')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Constraints
            |--------------------------------------------------------------------------
            */

            $table->unique(
                [
                    'session_id',
                    'student_id',
                    'student_fee_assignment_detail_id',
                    'concession_type_id'
                ],
                'uq_student_fee_concession'
            );

            $table->index(
                [
                    'school_id',
                    'session_id',
                    'student_id'
                ],
                'idx_student_fee_concession'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_concessions');
    }
};
