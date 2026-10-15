<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_attendance', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Employee
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | School / Branch
            |--------------------------------------------------------------------------
            */

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('branch_id')
                ->nullable()
                ->constrained('branches')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Shift
            |--------------------------------------------------------------------------
            */

            $table->foreignId('shift_id')
                ->nullable()
                ->constrained('shifts')
                ->nullOnDelete();

            $table->foreignId('employee_shift_assignment_id')
                ->nullable()
                ->constrained('employee_shift_assignments')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Attendance Date
            |--------------------------------------------------------------------------
            */

            $table->date('attendance_date');


            /*
            |--------------------------------------------------------------------------
            | Attendance Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('attendance_status')
                ->default(1);

            /*
             * 1  = Present
             * 2  = Absent
             * 3  = Half Day
             * 4  = Paid Leave
             * 5  = Unpaid Leave / LOP
             * 6  = Holiday
             * 7  = Weekly Off
             * 8  = Work From Home
             * 9  = On Duty
             * 10 = Comp Off
             * 11 = Late
             * 12 = Early Exit
             */


            /*
            |--------------------------------------------------------------------------
            | First IN / Last OUT
            |--------------------------------------------------------------------------
            */

            $table->dateTime('first_in')
                ->nullable();

            $table->dateTime('last_out')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Raw Punch Information
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('total_punches')
                ->default(0);

            $table->dateTime('first_punch_at')
                ->nullable();

            $table->dateTime('last_punch_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Working Time
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('scheduled_minutes')
                ->default(0);

            $table->unsignedInteger('worked_minutes')
                ->default(0);

            $table->unsignedInteger('break_minutes')
                ->default(0);

            $table->unsignedInteger('short_minutes')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Late / Early
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('late_minutes')
                ->default(0);

            $table->unsignedInteger('early_exit_minutes')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Overtime
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('overtime_minutes')
                ->default(0);

            $table->unsignedInteger('approved_overtime_minutes')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Attendance Units
            |--------------------------------------------------------------------------
            */

            $table->decimal('present_days', 5, 2)
                ->default(0);

            $table->decimal('paid_leave_days', 5, 2)
                ->default(0);

            $table->decimal('unpaid_leave_days', 5, 2)
                ->default(0);

            $table->decimal('lop_days', 5, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Grace / Rules
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('grace_minutes')
                ->default(0);

            $table->boolean('is_late')
                ->default(false);

            $table->boolean('is_early_exit')
                ->default(false);

            $table->boolean('is_overtime')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Source
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('source')
                ->default(1);

            /*
             * 1 = Biometric
             * 2 = Manual
             * 3 = Mobile
             * 4 = Web
             * 5 = Import
             * 6 = API
             */


            /*
            |--------------------------------------------------------------------------
            | Processing
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('processing_status')
                ->default(1);

            /*
             * 1 = Raw
             * 2 = Processed
             * 3 = Approved
             * 4 = Locked
             */


            $table->timestamp('processed_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Approval
            |--------------------------------------------------------------------------
            */

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Regularization
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_regularized')
                ->default(false);

            $table->foreignId('regularized_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('regularized_at')
                ->nullable();

            $table->text('regularization_reason')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Remarks
            |--------------------------------------------------------------------------
            */

            $table->text('remarks')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Audit
            |--------------------------------------------------------------------------
            */

                    $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();


            $table->timestamps();
            $table->softDeletes();


            /*
            |--------------------------------------------------------------------------
            | Unique Attendance
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'employee_id',
                'attendance_date'
            ]);


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('school_id');
            $table->index('branch_id');

            $table->index('shift_id');
            $table->index('employee_shift_assignment_id');

            $table->index('attendance_date');
            $table->index('attendance_status');

            $table->index('processing_status');
            $table->index('source');

            $table->index('is_regularized');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_attendance');
    }
};