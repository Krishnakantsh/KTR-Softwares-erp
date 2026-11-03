<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                 ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('invoice_id')
                   ->constrained('subscription_invoices')
                ->cascadeOnDelete();

            $table->string('payment_no')
                ->unique();

            $table->datetime('payment_date');

            $table->decimal('amount', 12, 2);

            $table->enum('payment_method', [
                'cash',
                'upi',
                'bank_transfer',
                'cheque',
                'card',
                'gateway'
            ]);

            $table->enum('gateway', [
                'razorpay',
                'cashfree',
                'phonepe',
                'none'
            ])->default('none');

            $table->string('transaction_id')
                ->nullable();

            $table->string('gateway_payment_id')
                ->nullable();

            $table->string('gateway_order_id')
                ->nullable();

            $table->string('gateway_signature')
                ->nullable();

            $table->json('gateway_response')
                ->nullable();

            $table->enum('status', [
                'pending',
                'success',
                'failed',
                'cancelled',
                'refunded'
            ])->default('pending');

            $table->text('remarks')
                ->nullable();

            $table->unsignedBigInteger('received_by')
                ->nullable();

            $table->timestamps();
             $table->softDeletes();

            $table->index('tenant_id');
            $table->index('invoice_id');
            $table->index('payment_no');
            $table->index('transaction_id');
            $table->index('status');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('subscription_payments');
    }
};
