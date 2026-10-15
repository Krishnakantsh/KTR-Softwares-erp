<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_payroll_details', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Payroll
            |--------------------------------------------------------------------------
            |
            | This detail belongs to one generated monthly payroll.
            |
            */

            $table->foreignId('employee_payroll_id')
                ->constrained('employee_payrolls')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Employee
            |--------------------------------------------------------------------------
            |
            | Kept directly for faster reporting/filtering.
            |
            */

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Component
            |--------------------------------------------------------------------------
            |
            | Example:
            | Basic Salary
            | HRA
            | Transport
            | PF
            | TDS
            | Overtime
            |
            | component_id will point to the original salary component
            | wherever applicable.
            |
            */

            $table->unsignedBigInteger('component_id')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Component Name Snapshot
            |--------------------------------------------------------------------------
            |
            | Important:
            |
            | If the component name changes later, old payslip should still
            | show the original name.
            |
            */

            $table->string('component_name', 150);


            /*
            |--------------------------------------------------------------------------
            | Component Code Snapshot
            |--------------------------------------------------------------------------
            */

            $table->string('component_code', 60)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Component Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('component_type');

            /*
             * 1 = Basic
             * 2 = Allowance
             * 3 = Overtime
             * 4 = Bonus
             * 5 = Incentive
             * 6 = Arrear
             * 7 = Other Earning
             * 8 = Deduction
             * 9 = Tax
             * 10 = Provident Fund
             * 11 = Loan
             * 12 = Advance
             * 13 = LOP
             * 14 = Other Deduction
             */


            /*
            |--------------------------------------------------------------------------
            | Calculation Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('calculation_type')
                ->nullable();

            /*
             * 1 = Fixed
             * 2 = Percentage
             * 3 = Per Day
             * 4 = Per Hour
             * 5 = Actual
             * 6 = Manual
             */


            /*
            |--------------------------------------------------------------------------
            | Calculation Base
            |--------------------------------------------------------------------------
            |
            | Example:
            |
            | HRA = 40% of Basic
            |
            | calculation_base = 25000
            |
            */

            $table->decimal('calculation_base', 14, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Percentage
            |--------------------------------------------------------------------------
            */

            $table->decimal('percentage', 8, 4)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Quantity
            |--------------------------------------------------------------------------
            |
            | Useful for:
            |
            | Overtime hours
            | Leave days
            | LOP days
            | Working days
            |
            */

            $table->decimal('quantity', 10, 2)
                ->default(1);


            /*
            |--------------------------------------------------------------------------
            | Rate
            |--------------------------------------------------------------------------
            */

            $table->decimal('rate', 14, 4)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Amount
            |--------------------------------------------------------------------------
            */

            $table->decimal('amount', 14, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Is Earning / Deduction
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('effect');

            /*
             * 1 = Earning
             * 2 = Deduction
             */


            /*
            |--------------------------------------------------------------------------
            | Taxable
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_taxable')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Included In Gross
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_included_in_gross')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Included In Net
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_included_in_net')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Display Order
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('display_order')
                ->default(0);


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

            $table->index('employee_payroll_id');

            $table->index('employee_id');

            $table->index('component_id');

            $table->index('component_type');

            $table->index('effect');

            $table->index('is_taxable');

            $table->index('display_order');


            /*
            |--------------------------------------------------------------------------
            | Composite Index
            |--------------------------------------------------------------------------
            */

            $table->index([
                'employee_payroll_id',
                'effect'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_payroll_details');
    }
};
