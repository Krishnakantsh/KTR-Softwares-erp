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
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->nullable()
                ->constrained('all_schools')
                ->nullOnDelete();

            $table->foreignId('notification_template_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('channel');

            $table->string('notification_type');

            $table->string('recipient');

            $table->string('subject')
                ->nullable();

            $table->longText('message');

            $table->enum('status', [
                'pending',
                'queued',
                'sent',
                'delivered',
                'failed',
                'read'
            ])->default('pending');

            $table->string('provider')
                ->nullable();

            $table->string('provider_message_id')
                ->nullable();

            $table->json('provider_response')
                ->nullable();

            $table->text('failure_reason')
                ->nullable();

            $table->timestamp('queued_at')
                ->nullable();

            $table->timestamp('sent_at')
                ->nullable();

            $table->timestamp('delivered_at')
                ->nullable();

            $table->timestamp('read_at')
                ->nullable();

            $table->json('metadata')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('tenant_id');
            $table->index('notification_template_id');
            $table->index('channel');
            $table->index('status');
            $table->index('recipient');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};
