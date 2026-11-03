<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fee_ledgers', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('fee_structure_id');
            $table->unsignedBigInteger('fee_head_id');
            $table->unsignedBigInteger('fee_installment_detail_id');

            $table->decimal('amount', 10, 2);

            $table->decimal('concession_amount', 10, 2)->default(0);

            $table->decimal('fine_amount', 10, 2)->default(0);

            $table->decimal('paid_amount', 10, 2)->default(0);

            $table->decimal('balance_amount', 10, 2);

            /*
            0 = Pending
            1 = Partial
            2 = Paid
            3 = Cancelled
            */

            $table->tinyInteger('payment_status')->default(0);

            $table->date('due_date')->nullable();

            $table->date('paid_date')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('session_id', 'sfl_ses_fk')
                ->references('id')
                ->on('academic_sessions')
                ->cascadeOnDelete();

            $table->foreign('student_id', 'sfl_std_fk')
                ->references('id')
                ->on('students')
                ->cascadeOnDelete();

            $table->foreign('fee_structure_id', 'sfl_fs_fk')
                ->references('id')
                ->on('fee_structures')
                ->cascadeOnDelete();

            $table->foreign('fee_head_id', 'sfl_fh_fk')
                ->references('id')
                ->on('fee_heads')
                ->cascadeOnDelete();

            $table->foreign('fee_installment_detail_id', 'sfl_fid_fk')
                ->references('id')
                ->on('fee_installment_details')
                ->cascadeOnDelete();

            // Index
            $table->index(
                ['school_id', 'session_id', 'student_id'],
                'sfl_sch_ses_std_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_ledgers');
    }
};
