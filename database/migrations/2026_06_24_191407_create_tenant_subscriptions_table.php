<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('tenant_subscriptions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('tenant_id')
                ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('subscription_plan_id')
                ->constrained()
                ->restrictOnDelete();

            $table->enum('billing_cycle', [
                'monthly',
                'quarterly',
                'half_yearly',
                'yearly'
            ]);

            $table->timestamp('activated_at')->nullable();

            $table->timestamp('cancelled_at')->nullable();

            $table->timestamp('suspended_at')->nullable();

            $table->timestamp('expired_at')->nullable();

            $table->date('start_date');

            $table->date('end_date');

            $table->boolean('is_trial')
                ->default(false);

            $table->date('trial_start_date')
                ->nullable();

            $table->date('trial_end_date')
                ->nullable();

            $table->decimal('amount', 12, 2)
                ->default(0);

            $table->decimal('discount', 12, 2)
                ->default(0);

            $table->decimal('tax', 12, 2)
                ->default(0);

            $table->decimal('final_amount', 12, 2)
                ->default(0);

            $table->enum('status', [
                'trial',
                'active',
                'grace_period',
                'expired',
                'cancelled',
                'suspended'
            ])->default('trial');

            $table->boolean('auto_renew')
                ->default(false);

            $table->integer('renewal_count')
                ->default(0);

            $table->text('remarks')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('tenant_id');
            $table->index('subscription_plan_id');
            $table->index('status');
            $table->index('end_date');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('tenant_subscriptions');
    }
};
