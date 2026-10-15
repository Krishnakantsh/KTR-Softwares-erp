<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_weekly_offs', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->unsignedBigInteger('session_id');

            $table->enum('day_of_week', [
                'monday',
                'tuesday',
                'wednesday',
                'thursday',
                'friday',
                'saturday',
                'sunday'
            ]);

            /*
            |--------------------------------------------------------------------------
            | Applies To
            |--------------------------------------------------------------------------
            */
            $table->enum('applicable_to', [
                'all',
                'students',
                'staff',
                'teachers'
            ])->default('all');

            /*
            |--------------------------------------------------------------------------
            | Optional custom rule
            |--------------------------------------------------------------------------
            */
            $table->enum('off_type', [
                'weekly',
                'alternate',
                'custom'
            ])->default('weekly');

            /*
            |--------------------------------------------------------------------------
            | Alternate Saturday etc.
            |--------------------------------------------------------------------------
            */
            $table->json('weeks')->nullable();

            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

              $table->unique(
                [
                    'school_id',
                    'session_id',
                    'day_of_week',
                    'applicable_to'
                ],
                'cal_weekly_off_unique'
            );
            $table->index([
                'school_id',
                'session_id',
                'is_active'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_weekly_offs');
    }
};
