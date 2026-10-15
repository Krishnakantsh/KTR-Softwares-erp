<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_events', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->unsignedBigInteger('session_id');

            $table->unsignedBigInteger('event_type_id');

            $table->string('title');

            $table->string('slug')->nullable();

            $table->text('description')->nullable();

            $table->date('start_date');
            $table->date('end_date')->nullable();

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->boolean('is_full_day')->default(true);

            /*
            |--------------------------------------------------------------------------
            | Holiday
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_holiday')->default(false);

            $table->enum('holiday_type', [
                'national',
                'state',
                'school',
                'restricted',
                'vacation',
                'other'
            ])->nullable();

            /*
            |--------------------------------------------------------------------------
            | Applicability
            |--------------------------------------------------------------------------
            */
            $table->enum('applicable_to', [
                'all',
                'students',
                'staff',
                'teachers',
                'parents'
            ])->default('all');

            /*
            |--------------------------------------------------------------------------
            | Location / Display
            |--------------------------------------------------------------------------
            */
            $table->string('location')->nullable();

            $table->string('color')->nullable();

            $table->enum('priority', [
                'low',
                'normal',
                'high',
                'critical'
            ])->default('normal');

            /*
            |--------------------------------------------------------------------------
            | Recurrence
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_recurring')->default(false);

            $table->unsignedBigInteger('recurrence_id')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'draft',
                'published',
                'cancelled'
            ])->default('published');

            /*
            |--------------------------------------------------------------------------
            | Audit
            |--------------------------------------------------------------------------
            */
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
                $table->softDeletes();

            $table->index(['school_id', 'session_id']);

            $table->index([
                'school_id',
                'start_date',
                'end_date'
            ]);

            $table->index([
                'school_id',
                'is_holiday'
            ]);

            $table->index([
                'school_id',
                'event_type_id'
            ]);

            $table->index([
                'school_id',
                'status'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_events');
    }
};
