<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_classes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('class_id')
                ->constrained('class_masters')
                ->cascadeOnDelete();

            $table->foreignId('stream_id')
                ->constrained('stream_masters')
                ->cascadeOnDelete();

            $table->foreignId('section_id')
                ->constrained('class_sections')
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                 ->nullable()
                ->constrained('subjects')
                ->nullOnDelete();

            $table->foreignId('session_id')
                ->nullable()
                ->constrained('academic_sessions')
                ->nullOnDelete();


            $table->enum('platform', [
                'google_meet',
                'zoom',
                'microsoft_teams',
                'other'
            ])->default('google_meet');

            $table->string('title');

            $table->text('description')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('teacher_id')->nullable();

            $table->string('meeting_link')->nullable();

            $table->string('meeting_id')->nullable();

            $table->string('password')->nullable();

            $table->date('held_date');

            $table->time('held_time');

            $table->integer('duration')
                ->nullable()
                ->comment('Duration in minutes');

            $table->enum('status', [
                'scheduled',
                'ongoing',
                'completed',
                'cancelled'
            ])->default('scheduled');

            $table->softDeletes();
            $table->timestamps();

            $table->index([
                'class_id',
                'section_id',
                'subject_id',
                'held_date'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_classes');
    }
};
