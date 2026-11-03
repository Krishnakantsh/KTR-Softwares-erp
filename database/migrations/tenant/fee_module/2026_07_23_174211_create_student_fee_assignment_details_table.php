<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('student_fee_assignment_details', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_fee_assignment_id');

            $table->unsignedBigInteger('fee_head_id');

            $table->unsignedBigInteger('fee_installment_detail_id');

            $table->decimal('amount', 10, 2);

            $table->boolean('is_optional')->default(false);

            $table->boolean('allow_concession')->default(true);

            $table->boolean('allow_fine')->default(true);

            $table->integer('display_order')->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('student_fee_assignment_id', 'sfad_assignment_fk')
                ->references('id')
                ->on('student_fee_assignments')
                ->cascadeOnDelete();

            $table->foreign('fee_head_id', 'sfad_head_fk')
                ->references('id')
                ->on('fee_heads')
                ->cascadeOnDelete();

            $table->foreign('fee_installment_detail_id', 'sfad_installment_fk')
                ->references('id')
                ->on('fee_installment_details')
                ->cascadeOnDelete();

            $table->unique(
                [
                    'student_fee_assignment_id',
                    'fee_head_id',
                    'fee_installment_detail_id'
                ],
                'uq_student_fee_assignment_detail'
            );

            $table->index(
                ['student_fee_assignment_id'],
                'idx_sfad_assignment'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fee_assignment_details');
    }
};
