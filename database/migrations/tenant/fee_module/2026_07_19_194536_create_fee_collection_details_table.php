<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_collection_details', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('fee_collection_id');

            $table->unsignedBigInteger('student_fee_ledger_id');

            $table->decimal('amount', 10, 2);

            $table->decimal('concession_amount', 10, 2)->default(0);

            $table->decimal('fine_amount', 10, 2)->default(0);

            $table->decimal('paid_amount', 10, 2);

            $table->timestamps();

            // Foreign Keys
            $table->foreign('fee_collection_id', 'fcd_fc_fk')
                ->references('id')
                ->on('fee_collections')
                ->cascadeOnDelete();

            $table->foreign('student_fee_ledger_id', 'fcd_sfl_fk')
                ->references('id')
                ->on('student_fee_ledgers')
                ->cascadeOnDelete();

            // Index
            $table->index(
                'student_fee_ledger_id',
                'fcd_sfl_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_collection_details');
    }
};