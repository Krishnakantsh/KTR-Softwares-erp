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
        Schema::create('notification_templates', function (Blueprint $table) {

            $table->id();

            // Admin Friendly Name
            $table->string('name');

            // fee_received
            // attendance_marked
            // homework_assigned
            $table->string('template_key');

            // en, hi
            $table->string('language', 10)->default('en');

            // Push Notification Title
            $table->string('title');

            // Push Notification Body
            $table->longText('content');

            // ["student_name","amount","receipt_no"]
            $table->json('variables')->nullable();

            $table->text('description')->nullable();

            $table->boolean('is_system')->default(false);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->softDeletes();

            $table->unique([
                'template_key',
                'language'
            ]);

            $table->index('template_key');
            $table->index('language');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_templates');
    }
};
