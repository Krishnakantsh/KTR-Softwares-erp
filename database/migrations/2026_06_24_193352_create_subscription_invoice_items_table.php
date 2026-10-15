<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('subscription_invoice_items', function (Blueprint $table) {

            $table->id();

            $table->foreignId('invoice_id')
                ->constrained('subscription_invoices')
                ->cascadeOnDelete();

            $table->enum('item_type', [
                'subscription_plan',
                'addon',
                'coupon',
                'sms_pack',
                'whatsapp_pack',
                'storage',
                'support_plan',
                'custom'
            ]);

            $table->unsignedBigInteger('reference_id')
                ->nullable();

            $table->string('title');

            $table->text('description')
                ->nullable();

            $table->decimal('quantity', 10, 2)
                ->default(1);

            $table->decimal('rate', 12, 2)
                ->default(0);

            $table->decimal('amount', 12, 2)
                ->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->index('invoice_id');
            $table->index('item_type');
            $table->index('reference_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_invoice_items');
    }
};
