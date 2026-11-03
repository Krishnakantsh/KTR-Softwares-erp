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
        Schema::create('school_app_users', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('registration_id')->nullable();

            $table->string('mobile_no', 10)->unique();
            $table->string('email')->nullable();

            // Hashed Password
            $table->text('password');

            // Base64 Encoded Hashed Password
            $table->text('user_key');

            $table->text('notification_token')->nullable();

            $table->integer('check_flag')->default(0);

            $table->string('switch_branch_permission', 50)->nullable();

            $table->boolean('is_active')->default(true);

            $table->tinyInteger('login_status')->default(0);

            $table->foreignId('school_id')
                ->constrained('all_schools')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_app_users');
    }
};