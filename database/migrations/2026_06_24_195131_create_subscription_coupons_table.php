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
        Schema::create('subscription_coupons', function (Blueprint $table) {


            $table->id();

            $table->string('name');

            $table->string('code')
                ->unique();

            $table->enum('discount_type', [
                'fixed',
                'percentage'
            ]);

            $table->decimal(
                'discount_value',
                12,
                2
            );

            $table->decimal(
                'max_discount',
                12,
                2
            )->nullable();

            $table->decimal(
                'minimum_order_amount',
                12,
                2
            )->default(0);

            $table->integer('usage_limit')
                ->nullable();

            $table->integer('used_count')
                ->default(0);

            $table->integer('usage_per_customer')
                ->default(1);

            $table->dateTime('valid_from');

            $table->dateTime('valid_to');

            $table->boolean('is_first_purchase_only')
                ->default(false);

            $table->boolean('status')
                ->default(true);

            $table->text('description')
                ->nullable();

            $table->json('applicable_plans')
                ->nullable();

            $table->json('excluded_plans')
                ->nullable();

            $table->json('applicable_billing_cycles')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('code');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_coupons');
    }
};
