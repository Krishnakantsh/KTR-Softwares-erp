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
        Schema::create('subscription_invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                 ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('tenant_subscription_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('invoice_no')
                ->unique();

            $table->date('invoice_date');

            $table->date('due_date')
                ->nullable();

            $table->date('billing_period_from')
                ->nullable();

            $table->date('billing_period_to')
                ->nullable();

            $table->decimal('subtotal', 12, 2)
                ->default(0);

            $table->decimal('discount_amount', 12, 2)
                ->default(0);

            $table->decimal('tax_amount', 12, 2)
                ->default(0);

            $table->decimal('paid_amount', 12, 2)
                ->default(0);

            $table->decimal('grand_total', 12, 2)
                ->default(0);

            $table->decimal('due_amount', 12, 2)
                ->default(0);

            $table->enum('invoice_type', [
                'subscription',
                'renewal',
                'upgrade',
                'downgrade',
                'addon',
                'manual'
            ]);

            $table->enum('payment_status', [
                'pending',
                'partial',
                'paid',
                'failed',
                'refunded'
            ])->default('pending');

            $table->enum('status', [
                'draft',
                'generated',
                'cancelled'
            ])->default('generated');

            $table->text('remarks')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('tenant_id');
            $table->index('invoice_no');
            $table->index('payment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_invoices');
    }
};
