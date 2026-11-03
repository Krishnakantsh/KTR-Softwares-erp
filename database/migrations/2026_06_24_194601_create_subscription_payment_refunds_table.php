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
        Schema::create('subscription_payment_refunds', function (Blueprint $table) {
            $table->id();

            $table->foreignId('payment_id')
                 ->constrained('subscription_payments')
                ->cascadeOnDelete();

            $table->foreignId('tenant_id')
                 ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('invoice_id')
                ->nullable()
                ->constrained('subscription_invoices')
                ->nullOnDelete();

            $table->string('refund_no')
                ->unique();

            $table->dateTime('refund_date');

            $table->decimal('refund_amount', 12, 2);

            $table->enum('refund_type', [
                'full',
                'partial'
            ]);

            $table->string('refund_transaction_id')
                ->nullable();

            $table->string('gateway_refund_id')
                ->nullable();

            $table->json('gateway_response')
                ->nullable();

            $table->enum('status', [
                'pending',
                'processed',
                'failed',
                'cancelled'
            ])->default('pending');

            $table->text('reason')
                ->nullable();

            $table->unsignedBigInteger('processed_by')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('payment_id');
            $table->index('tenant_id');
            $table->index('refund_no');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_payment_refunds');
    }
};
