<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_overtimes', function (Blueprint $table) {

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
            | Attendance Reference
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_attendance_id')
                ->nullable()
                ->constrained('employee_attendance')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Overtime Rule
            |--------------------------------------------------------------------------
            */

            $table->foreignId('overtime_rule_id')
                ->nullable()
                ->constrained('overtime_rules')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Overtime Date
            |--------------------------------------------------------------------------
            */

            $table->date('overtime_date');


            /*
            |--------------------------------------------------------------------------
            | Day Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('day_type')
                ->default(1);

            /*
             * 1 = Working Day
             * 2 = Weekly Off
             * 3 = Holiday
             */


            /*
            |--------------------------------------------------------------------------
            | Overtime Time
            |--------------------------------------------------------------------------
            */

            $table->dateTime('overtime_start')
                ->nullable();

            $table->dateTime('overtime_end')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Overtime Minutes
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('actual_overtime_minutes')
                ->default(0);

            $table->unsignedInteger('eligible_overtime_minutes')
                ->default(0);

            $table->unsignedInteger('approved_overtime_minutes')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Rate
            |--------------------------------------------------------------------------
            */

            $table->decimal('hourly_rate', 12, 2)
                ->default(0);

            $table->decimal('overtime_multiplier', 5, 2)
                ->default(1.00);

            $table->decimal('overtime_rate', 12, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Amount
            |--------------------------------------------------------------------------
            */

            $table->decimal('calculated_amount', 14, 2)
                ->default(0);

            $table->decimal('approved_amount', 14, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Approval
            |--------------------------------------------------------------------------
            */

            $table->boolean('approval_required')
                ->default(true);

            $table->unsignedTinyInteger('approval_status')
                ->default(1);

            /*
             * 1 = Pending
             * 2 = Approved
             * 3 = Rejected
             * 4 = Cancelled
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
            | Payroll
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_payroll_processed')
                ->default(false);

            $table->unsignedBigInteger('payroll_id')
                ->nullable();

            $table->timestamp('payroll_processed_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Source
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('source')
                ->default(1);

            /*
             * 1 = Attendance System
             * 2 = Manual
             * 3 = Regularization
             * 4 = Import
             */


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

            $table->index('employee_id');

            $table->index('employee_attendance_id');

            $table->index('overtime_rule_id');

            $table->index('overtime_date');

            $table->index([
                'employee_id',
                'overtime_date'
            ]);

            $table->index('day_type');

            $table->index('approval_status');

            $table->index('is_payroll_processed');

            $table->index('payroll_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_overtimes');
    }
};