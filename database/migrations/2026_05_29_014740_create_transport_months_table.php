<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transport_months', function (Blueprint $table) {
            $table->id();
            $table->string('month_name');
            $table->string('slug')->unique();
            $table->boolean('transport_fee')->default(true);
            $table->boolean('is_transport_enable')->default(false);
            $table->boolean('status')->default(true);
            $table->integer('order')->default(0);
              $table->unsignedBigInteger('session_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_months');
    }
};
