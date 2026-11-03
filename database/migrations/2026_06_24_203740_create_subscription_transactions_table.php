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
        Schema::create('subscription_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                 ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('tenant_subscription_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('event_type');

            $table->string('reference_type')
                ->nullable();

            $table->unsignedBigInteger('reference_id')
                ->nullable();

            $table->decimal('amount', 12, 2)
                ->nullable();

            $table->json('old_values')
                ->nullable();

            $table->json('new_values')
                ->nullable();

            $table->json('metadata')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->unsignedBigInteger('created_by')
                ->nullable();

            $table->timestamp('event_at');

            $table->timestamps();

            $table->index('tenant_id');
            $table->index('tenant_subscription_id');
            $table->index('event_type');
            $table->index('event_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_transactions');
    }
};
