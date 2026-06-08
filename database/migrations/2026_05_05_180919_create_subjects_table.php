<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
             $table->string('session_id')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('subject_group_id')->constrained('subject_groups')->cascadeOnDelete();
            $table->timestamps();
             $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
