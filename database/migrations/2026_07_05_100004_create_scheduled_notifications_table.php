<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheduled_notifications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->json('data')->nullable();
            $table->enum('target_type', ['user', 'users', 'all', 'topic']);
            $table->text('target_value')->nullable();

            // Always stored in UTC. `timezone` remembers admin's original
            // picked zone (Asia/Kolkata, America/New_York, etc.) for display.
            $table->timestamp('scheduled_at')->index();
            $table->string('timezone')->default('UTC');

            $table->boolean('sent')->default(false)->index();
            $table->foreignId('notification_id')->nullable()->constrained('notifications')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduled_notifications');
    }
};
