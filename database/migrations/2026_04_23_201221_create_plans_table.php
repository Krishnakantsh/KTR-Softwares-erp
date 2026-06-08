<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name');
            $table->string('plane_code')->unique();
            $table->string('slug')->unique();
            $table->decimal('pricing', 10, 2);
            $table->decimal('min_pricing', 10, 2);
            $table->boolean('status')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('plan_models');
    }
};
