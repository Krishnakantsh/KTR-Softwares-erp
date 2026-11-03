<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_installment_details', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            // Foreign Key with short name
            $table->unsignedBigInteger('fee_installment_master_id');

            $table->foreign('fee_installment_master_id', 'fid_fk')
                ->references('id')
                ->on('fee_installment_masters')
                ->cascadeOnDelete();

            $table->string('installment_name', 50);

            $table->integer('installment_order')->default(0);

            $table->unsignedTinyInteger('start_month')->nullable();

            $table->unsignedTinyInteger('end_month')->nullable();

            $table->unsignedTinyInteger('due_day')
                ->nullable()
                ->comment('1-31');

            $table->unsignedTinyInteger('fine_after_days')
                ->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();
            
            $table->softDeletes();

            // Composite Index with short name
            $table->index(
                ['fee_installment_master_id', 'installment_order'],
                'fid_ord_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_installment_details');
    }
};
