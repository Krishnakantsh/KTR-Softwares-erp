<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('class_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('session_id')->nullable();
            $table->string('slug')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('class_master_id')->constrained()->cascadeOnDelete();
            $table->softDeletes();
             $table->string('session_id')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('class_sections');
    }
};
