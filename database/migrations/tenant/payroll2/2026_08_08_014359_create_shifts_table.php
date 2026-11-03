<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {

            $table->id();

            // School / Branch
            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('branch_id')
                ->constrained()
                ->cascadeOnDelete();

            // Basic Information
            $table->string('shift_name', 100);
            $table->string('shift_code', 30);

            // Shift Timing
            $table->time('start_time');
            $table->time('end_time');

            // Overnight Shift
            $table->boolean('is_overnight')->default(false);

            // Break
            $table->boolean('has_break')->default(false);
            $table->time('break_start_time')->nullable();
            $table->time('break_end_time')->nullable();

            // Working Hours
            $table->decimal('working_hours', 5, 2)->default(0);
            $table->decimal('break_hours', 5, 2)->default(0);

            // Attendance Grace
            $table->unsignedSmallInteger('late_grace_minutes')->default(0);
            $table->unsignedSmallInteger('early_grace_minutes')->default(0);

            // Half Day
            $table->unsignedSmallInteger('half_day_after_minutes')->nullable();

            // Overtime
            $table->boolean('overtime_allowed')->default(false);
            $table->unsignedSmallInteger('overtime_after_minutes')->default(0);

            // Attendance Rules
            $table->boolean('late_mark_enabled')->default(true);
            $table->boolean('early_out_enabled')->default(true);

            // Status
            $table->boolean('status')->default(true);

            $table->text('description')->nullable();

            // Audit
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Unique
            $table->unique([
                'branch_id',
                'shift_code'
            ]);

            $table->unique([
                'branch_id',
                'shift_name'
            ]);

            // Indexes
            $table->index('school_id');
            $table->index('branch_id');
            $table->index('status');
            $table->index('is_overnight');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};