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
        Schema::create('subscription_coupon_usages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('coupon_id')
                ->constrained('subscription_coupons')
                ->cascadeOnDelete();

            $table->foreignId('tenant_id')
             ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('invoice_id')
                ->nullable()
                ->constrained('subscription_invoices')
                ->nullOnDelete();

            $table->decimal(
                'invoice_amount',
                12,
                2
            )->default(0);

            $table->decimal(
                'discount_amount',
                12,
                2
            )->default(0);

            $table->enum('usage_type', [
                'subscription',
                'renewal',
                'upgrade',
                'addon'
            ]);

            $table->foreignId('tenant_subscription_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

                
            $table->timestamp('used_at');

            $table->json('meta')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('coupon_id');
            $table->index('tenant_id');
            $table->index('invoice_id');
            $table->index('used_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_coupon_usages');
    }
};
