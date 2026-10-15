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
        Schema::create('renewal_reminders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                 ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->foreignId('tenant_subscription_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('reminder_type');

            $table->integer('days_before');

            $table->date('expiry_date');

            $table->enum('channel', [
                'email',
                'sms',
                'whatsapp',
                'in_app'
            ]);

            $table->enum('status', [
                'pending',
                'sent',
                'failed',
                'cancelled'
            ])->default('pending');

            $table->timestamp('scheduled_at')
                ->nullable();

            $table->timestamp('sent_at')
                ->nullable();

            $table->text('message')
                ->nullable();

            $table->json('metadata')
                ->nullable();

            $table->text('failure_reason')
                ->nullable();

            $table->timestamps();

            $table->index('tenant_id');
            $table->index('tenant_subscription_id');
            $table->index('status');
            $table->index('scheduled_at');
            $table->index('expiry_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renewal_reminders');
    }
};
