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
        Schema::create('plan_features', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('slug')->unique();

            $table->string('module_name')->nullable();

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->softDeletes();

            $table->index('slug');

            $table->index('module_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_features');
    }
};
