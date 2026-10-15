<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_event_recurrences', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->enum('frequency', [
                'daily',
                'weekly',
                'monthly',
                'yearly'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Interval
            |--------------------------------------------------------------------------
            | Example:
            | 1 = every week
            | 2 = every 2 weeks
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('interval')->default(1);

            /*
            |--------------------------------------------------------------------------
            | Weekly
            |--------------------------------------------------------------------------
            */
            $table->json('days_of_week')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Monthly
            |--------------------------------------------------------------------------
            */
            $table->unsignedTinyInteger('day_of_month')->nullable();

            $table->unsignedTinyInteger('week_of_month')->nullable();

            $table->enum('week_day', [
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
                'sunday'
            ])->nullable();

            /*
            |--------------------------------------------------------------------------
            | Recurrence Range
            |--------------------------------------------------------------------------
            */
            $table->date('starts_on');
            $table->date('ends_on')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Limit
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('occurrences')->nullable();

            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'school_id',
                'frequency'
            ]);

            $table->index([
                'school_id',
                'is_active'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_event_recurrences');
    }
};
