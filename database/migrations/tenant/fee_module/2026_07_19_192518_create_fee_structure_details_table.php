<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_structure_details', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('fee_structure_id');
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
            $table->foreign('fee_structure_id', 'fsd_fs_fk')
                ->references('id')
                ->on('fee_structures')
                ->cascadeOnDelete();

            $table->foreign('fee_head_id', 'fsd_fh_fk')
                ->references('id')
                ->on('fee_heads')
                ->cascadeOnDelete();

            $table->foreign('fee_installment_detail_id', 'fsd_fid_fk')
                ->references('id')
                ->on('fee_installment_details')
                ->cascadeOnDelete();

            // Unique Key
            $table->unique(
                [
                    'fee_structure_id',
                    'fee_head_id',
                    'fee_installment_detail_id'
                ],
                'uq_fee_structure_detail'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_structure_details');
    }
};
