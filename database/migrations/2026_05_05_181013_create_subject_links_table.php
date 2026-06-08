<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('subject_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->constrained('class_masters')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->boolean('status')->default(true);
            $table->unique(['class_id', 'subject_id']);
             $table->string('session_id')->nullable();
            $table->timestamps();
             $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_links');
    }
};
