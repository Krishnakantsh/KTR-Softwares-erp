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
        Schema::create('plan_price_histories', function (Blueprint $table) {

            $table->id();

            $table->foreignId('subscription_plan_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('billing_cycle', [
                'monthly',
                'quarterly',
                'half_yearly',
                'yearly'
            ]);

            $table->decimal('price', 12, 2);

            $table->decimal('setup_fee', 12, 2)
                ->default(0);

            $table->date('effective_from');

            $table->date('effective_to')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->text('remarks')
                ->nullable();

            $table->unsignedBigInteger('created_by')
                ->nullable();

            $table->timestamps();

            $table->index('subscription_plan_id');
            $table->index('billing_cycle');
            $table->index('effective_from');
            $table->index('effective_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_price_histories');
    }
};
