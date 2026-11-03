<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('softwares', function (Blueprint $table) {
            $table->id();
            $table->string('name', '120')->nullable();
            $table->string('slug', '120')->nullable();
            $table->string('prod_key', '20')->unique();
            $table->integer('order')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('softwares');
    }
};
