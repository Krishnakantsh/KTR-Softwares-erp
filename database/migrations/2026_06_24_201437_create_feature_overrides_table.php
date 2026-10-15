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
        Schema::create('feature_overrides', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                 ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('plan_feature_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->boolean('is_enabled');

            $table->date('start_date')
                ->nullable();

            $table->date('end_date')
                ->nullable();

            $table->text('reason')
                ->nullable();

            $table->unsignedBigInteger('created_by')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique([
                'tenant_id',
                'plan_feature_id'
            ]);

            $table->index('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_overrides');
    }
};
