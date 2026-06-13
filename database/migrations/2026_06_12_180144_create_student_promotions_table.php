<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('student_promotions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('from_session_id');
            $table->foreignId('from_class_id');
            $table->foreignId('from_section_id')->nullable();

            $table->foreignId('to_session_id');
            $table->foreignId('to_class_id');
            $table->foreignId('to_section_id')->nullable();

            $table->date('promotion_date');

            $table->foreignId('promoted_by')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->index('student_id');
            $table->index('from_session_id');
            $table->index('to_session_id');
            $table->index('promotion_date');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('student_promotions');
    }
};
