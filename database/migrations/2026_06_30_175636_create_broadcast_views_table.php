<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('broadcast_views', function (Blueprint $table) {

            $table->id();

            $table->foreignId('broadcast_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->enum('platform', [
                'web',
                'android',
                'ios'
            ])->default('web');

            $table->string('device')->nullable();
            $table->string('ip_address')->nullable();

            $table->timestamp('seen_at')->nullable();
            $table->timestamp('clicked_at')->nullable();
            $table->timestamp('dismissed_at')->nullable();
            $table->timestamp('acknowledged_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['broadcast_id', 'tenant_id']);
            $table->index('tenant_id');
            $table->index('user_id');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('broadcast_views');
    }
};
