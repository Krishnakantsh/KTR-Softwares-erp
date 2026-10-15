<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_fine_rule_amounts', function (Blueprint $table) {

            $table->id();

            // Which row (period slab) this amount belongs to
            $table->unsignedBigInteger('fee_fine_rule_id');

            // Which target month column this amount belongs to
            // (the installment month for which this fine applies)
            $table->unsignedBigInteger('target_month_id');

            $table->decimal('fine_amount', 10, 2)->default(0);

            $table->timestamps();

            $table->foreign('fee_fine_rule_id', 'ffra_ffr_fk')
                ->references('id')
                ->on('fee_fine_rules')
                ->cascadeOnDelete();

            $table->foreign('target_month_id', 'ffra_tm_fk')
                ->references('id')
                ->on('transport_months')
                ->cascadeOnDelete();

            // Ek row ke andar ek target month ka sirf ek hi amount ho sakta hai
            $table->unique(['fee_fine_rule_id', 'target_month_id'], 'uq_ffra_rule_month');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_fine_rule_amounts');
    }
};
