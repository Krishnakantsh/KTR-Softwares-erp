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
        Schema::create('tenant_usages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('tenant_id')
                ->unique()
                 ->constrained('all_schools')
                ->cascadeOnDelete();

            $table->integer('students_count')
                ->default(0);

            $table->integer('users_count')
                ->default(0);

            $table->integer('teachers_count')
                ->default(0);

            $table->integer('branches_count')
                ->default(0);

            $table->bigInteger('sms_count')
                ->default(0);

            $table->bigInteger('whatsapp_count')
                ->default(0);

            $table->decimal('storage_used_gb', 12, 2)
                ->default(0);

            $table->bigInteger('api_requests_count')
                ->default(0);

            $table->timestamp('last_calculated_at')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_usages');
    }
};
