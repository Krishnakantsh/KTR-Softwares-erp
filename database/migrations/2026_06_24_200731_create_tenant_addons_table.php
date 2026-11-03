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
        Schema::create('tenant_addons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                  ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('tenant_subscription_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('add_on_module_id')
                ->constrained()
                ->restrictOnDelete();

            $table->enum('billing_cycle', [
                'monthly',
                'quarterly',
                'half_yearly',
                'yearly',
                'one_time'
            ]);

            $table->date('start_date');

            $table->date('end_date')
                ->nullable();

            $table->decimal('setup_fee', 12, 2)
                ->default(0);

            $table->decimal('amount', 12, 2)
                ->default(0);

            $table->boolean('auto_renew')
                ->default(false);

            $table->foreignId('subscription_invoice_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->enum('status', [
                'pending',
                'active',
                'expired',
                'cancelled',
                'suspended'
            ])->default('pending');

            $table->timestamp('activated_at')
                ->nullable();

            $table->timestamp('expired_at')
                ->nullable();

            $table->timestamp('cancelled_at')
                ->nullable();

            $table->json('metadata')
                ->nullable();

            $table->text('remarks')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('tenant_id');
            $table->index('tenant_subscription_id');
            $table->index('add_on_module_id');
            $table->index('status');
            $table->index('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_addons');
    }
};
