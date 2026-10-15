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
        Schema::create('subscription_plans', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('code')->unique();

            $table->text('description')->nullable();

            $table->decimal('monthly_price', 12, 2)->default(0);

            $table->decimal('quarterly_price', 12, 2)->default(0);

            $table->decimal('half_yearly_price', 12, 2)->default(0);
            
            $table->decimal('yearly_price', 12, 2)->default(0);

            $table->integer('trial_days')->default(0);

            $table->integer('max_students')->nullable();
            $table->integer('max_users')->nullable();
            $table->integer('max_branches')->nullable();

            $table->boolean('is_custom')->default(false);

            $table->integer('sort_order')->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index('code');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
