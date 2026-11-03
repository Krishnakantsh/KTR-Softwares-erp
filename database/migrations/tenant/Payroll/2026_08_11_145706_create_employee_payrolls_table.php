<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_payrolls', function (Blueprint $table) {

            $table->id();

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
            | Employee
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Payroll Month
            |--------------------------------------------------------------------------
            |
            | Payroll is always generated from the 1st day of the month
            | to the last day of that month.
            |
            */

            $table->unsignedTinyInteger('payroll_month');

            $table->unsignedSmallInteger('payroll_year');

            $table->date('period_start');

            $table->date('period_end');


            /*
            |--------------------------------------------------------------------------
            | Salary Structure Reference
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('salary_structure_id')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Attendance Summary
            |--------------------------------------------------------------------------
            */

            $table->decimal('total_days', 6, 2)
                ->default(0);

            $table->decimal('working_days', 6, 2)
                ->default(0);

            $table->decimal('present_days', 6, 2)
                ->default(0);

            $table->decimal('paid_leave_days', 6, 2)
                ->default(0);

            $table->decimal('absent_days', 6, 2)
                ->default(0);

            $table->decimal('lop_days', 6, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Attendance / LOP Deduction
            |--------------------------------------------------------------------------
            */

            $table->decimal('lop_amount', 14, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Earnings
            |--------------------------------------------------------------------------
            */

            $table->decimal('basic_salary', 14, 2)
                ->default(0);

            $table->decimal('total_allowances', 14, 2)
                ->default(0);

            $table->decimal('overtime_amount', 14, 2)
                ->default(0);

            $table->decimal('arrears', 14, 2)
                ->default(0);

            $table->decimal('bonus', 14, 2)
                ->default(0);

            $table->decimal('incentive', 14, 2)
                ->default(0);

            $table->decimal('other_earnings', 14, 2)
                ->default(0);

            $table->decimal('gross_earnings', 14, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Deductions
            |--------------------------------------------------------------------------
            */

            $table->decimal('total_deductions', 14, 2)
                ->default(0);

            $table->decimal('loan_deduction', 14, 2)
                ->default(0);

            $table->decimal('advance_deduction', 14, 2)
                ->default(0);

            $table->decimal('other_deductions', 14, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Final Salary
            |--------------------------------------------------------------------------
            */

            $table->decimal('net_salary', 14, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Rounding
            |--------------------------------------------------------------------------
            */

            $table->decimal('round_off', 10, 2)
                ->default(0);

            $table->decimal('payable_salary', 14, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Salary Snapshot
            |--------------------------------------------------------------------------
            |
            | Generated salary ke time allowances/deductions ka complete
            | snapshot preserve karne ke liye.
            |
            */

            $table->json('earnings_snapshot')
                ->nullable();

            $table->json('deductions_snapshot')
                ->nullable();

            $table->json('salary_snapshot')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Payroll Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('status')
                ->default(1);

            /*
             * 1 = Draft
             * 2 = Generated
             * 3 = Approved
             * 4 = Locked
             * 5 = Paid
             * 6 = Cancelled
             */


            /*
            |--------------------------------------------------------------------------
            | Generation
            |--------------------------------------------------------------------------
            */

            $table->timestamp('generated_at')
                ->nullable();

            $table->foreignId('generated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Approval
            |--------------------------------------------------------------------------
            */

            $table->timestamp('approved_at')
                ->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Payment
            |--------------------------------------------------------------------------
            */

            $table->timestamp('paid_at')
                ->nullable();

            $table->foreignId('paid_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Payment Reference
            |--------------------------------------------------------------------------
            */

            $table->string('payment_reference', 150)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Payslip
            |--------------------------------------------------------------------------
            */

            $table->string('payslip_number', 100)
                ->nullable();

            $table->string('payslip_path')
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
            | One Payroll Per Employee Per Month
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'employee_id',
                'payroll_month',
                'payroll_year'
            ]);


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('school_id');

            $table->index('branch_id');

            $table->index('employee_id');

            $table->index([
                'school_id',
                'payroll_year',
                'payroll_month'
            ]);

            $table->index('status');

            $table->index('period_start');

            $table->index('period_end');

            $table->index('payslip_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_payrolls');
    }
};