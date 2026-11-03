<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('account_cost_centers', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('code')->unique();

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('account_cost_centers');
    }
};
