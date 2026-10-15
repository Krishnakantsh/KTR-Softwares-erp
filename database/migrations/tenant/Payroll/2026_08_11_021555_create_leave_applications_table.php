<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_applications', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Application Identity
            |--------------------------------------------------------------------------
            */

            $table->string('application_number', 50);


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
            | Leave Type
            |--------------------------------------------------------------------------
            */

            $table->foreignId('leave_type_id')
                ->constrained('leave_types')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Leave Assignment
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_leave_assignment_id')
                ->nullable()
                ->constrained('employee_leave_assignments')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Leave Dates
            |--------------------------------------------------------------------------
            */

            $table->date('from_date');

            $table->date('to_date');


            /*
            |--------------------------------------------------------------------------
            | Duration
            |--------------------------------------------------------------------------
            */

            $table->decimal('total_days', 8, 2)
                ->default(0);

            $table->decimal('total_hours', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Leave Unit
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('leave_unit')
                ->default(1);

            /*
             * 1 = Full Day
             * 2 = Half Day
             * 3 = Hourly
             */


            /*
            |--------------------------------------------------------------------------
            | Half Day
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('half_day_type')
                ->nullable();

            /*
             * 1 = First Half
             * 2 = Second Half
             */


            /*
            |--------------------------------------------------------------------------
            | Hourly Leave
            |--------------------------------------------------------------------------
            */

            $table->time('from_time')
                ->nullable();

            $table->time('to_time')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Reason
            |--------------------------------------------------------------------------
            */

            $table->text('reason')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Contact During Leave
            |--------------------------------------------------------------------------
            */

            $table->string('contact_number', 20)
                ->nullable();

            $table->string('contact_address', 255)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Attachment
            |--------------------------------------------------------------------------
            */

            $table->string('attachment')
                ->nullable();

            $table->string('attachment_name')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Emergency Leave
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_emergency')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Applied Date
            |--------------------------------------------------------------------------
            */

            $table->timestamp('applied_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Approval Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('approval_status')
                ->default(1);

            /*
             * 1 = Draft
             * 2 = Pending
             * 3 = Approved
             * 4 = Rejected
             * 5 = Cancelled
             * 6 = Withdrawn
             */


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

            $table->text('approval_remarks')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Rejection
            |--------------------------------------------------------------------------
            */

            $table->foreignId('rejected_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('rejected_at')
                ->nullable();

            $table->text('rejection_reason')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Cancellation
            |--------------------------------------------------------------------------
            */

            $table->foreignId('cancelled_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('cancelled_at')
                ->nullable();

            $table->text('cancellation_reason')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Payroll
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_payroll_processed')
                ->default(false);

            $table->timestamp('payroll_processed_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Attendance
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_attendance_processed')
                ->default(false);

            $table->timestamp('attendance_processed_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);


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
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->unique('application_number');

            $table->index('employee_id');
            $table->index('leave_type_id');
            $table->index('employee_leave_assignment_id');

            $table->index([
                'employee_id',
                'from_date',
                'to_date'
            ]);

            $table->index('from_date');
            $table->index('to_date');

            $table->index('approval_status');

            $table->index('is_payroll_processed');
            $table->index('is_attendance_processed');

            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_applications');
    }
};