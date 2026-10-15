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
        Schema::create('plan_feature_mappings', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('subscription_plan_id');
            $table->unsignedBigInteger('plan_feature_id');

            $table->foreign('subscription_plan_id', 'pfm_plan_fk')
                ->references('id')
                ->on('subscription_plans')
                ->cascadeOnDelete();

            $table->foreign('plan_feature_id', 'pfm_feature_fk')
                ->references('id')
                ->on('plan_features')
                ->cascadeOnDelete();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(
                ['subscription_plan_id', 'plan_feature_id'],
                'pfm_plan_feature_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_feature_mappings');
    }
};
