<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('school_app_user_devices', function (Blueprint $table) {

            $table->id();

            $table->foreignId('school_id')
                ->constrained('all_schools')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('school_app_user_id')
                ->constrained('school_app_users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->tinyInteger('user_type')->default(1);

            $table->longText('device_token');

            $table->string('device_id')->nullable();

            $table->string('device_name')->nullable();

            $table->enum('platform', ['android', 'ios', 'web'])
                ->default('android');

            $table->boolean('is_active')->default(true);

            $table->dateTime('last_login_at')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_app_user_devices');
    }
};
