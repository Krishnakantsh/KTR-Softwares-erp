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
        Schema::create('subscription_histories', function (Blueprint $table) {

            $table->id();

            $table->foreignId('tenant_subscription_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('tenant_id')
                ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('old_plan_id')
                ->nullable()
                ->constrained('subscription_plans')
                ->nullOnDelete();

            $table->foreignId('new_plan_id')
                ->nullable()
                ->constrained('subscription_plans')
                ->nullOnDelete();

            $table->enum('action', [
                'created',
                'trial_started',
                'trial_converted',
                'renewed',
                'upgraded',
                'downgraded',
                'cancelled',
                'expired',
                'suspended',
                'reactivated'
            ]);

            $table->decimal('amount', 12, 2)
                ->default(0);

            $table->json('meta')
                ->nullable();

            $table->text('remarks')
                ->nullable();

            $table->unsignedBigInteger('created_by')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('tenant_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_histories');
    }
};
