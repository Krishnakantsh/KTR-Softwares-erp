<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('overtime_rules', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Multi School / Branch
            |--------------------------------------------------------------------------
            |
            | A school may have different overtime policies for different branches.
            |
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
            | Rule Information
            |--------------------------------------------------------------------------
            */

            $table->string('rule_name', 150);

            $table->string('rule_code', 50);


            /*
            |--------------------------------------------------------------------------
            | Applicability
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('applicable_on')
                ->default(1);

            /*
             * 1 = All Days
             * 2 = Working Days
             * 3 = Weekly Off
             * 4 = Holiday
             * 5 = Working Day + Weekly Off
             * 6 = Working Day + Holiday
             */


            /*
            |--------------------------------------------------------------------------
            | Minimum Overtime
            |--------------------------------------------------------------------------
            |
            | Employee must complete this many extra minutes before overtime
            | becomes eligible.
            |
            */

            $table->unsignedInteger('minimum_overtime_minutes')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Rounding
            |--------------------------------------------------------------------------
            |
            | Example:
            | 17 minutes -> 15 minutes
            | 18 minutes -> 30 minutes
            |
            */

            $table->unsignedInteger('rounding_minutes')
                ->default(1);

            $table->unsignedTinyInteger('rounding_method')
                ->default(1);

            /*
             * 1 = Exact
             * 2 = Down
             * 3 = Up
             * 4 = Nearest
             */


            /*
            |--------------------------------------------------------------------------
            | Daily Overtime Limit
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('maximum_daily_overtime_minutes')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Monthly Overtime Limit
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('maximum_monthly_overtime_minutes')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Approval Required
            |--------------------------------------------------------------------------
            */

            $table->boolean('approval_required')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Payroll Calculation
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('calculation_method')
                ->default(1);

            /*
             * 1 = Hourly Rate
             * 2 = Basic Salary Based
             * 3 = Gross Salary Based
             * 4 = Fixed Amount Per Hour
             */


            /*
            |--------------------------------------------------------------------------
            | Overtime Multiplier
            |--------------------------------------------------------------------------
            */

            $table->decimal('overtime_multiplier', 5, 2)
                ->default(1.00);

            /*
             * Example:
             * 1.00 = Normal hourly rate
             * 1.50 = 1.5x hourly rate
             * 2.00 = Double hourly rate
             */


            /*
            |--------------------------------------------------------------------------
            | Fixed Hourly Amount
            |--------------------------------------------------------------------------
            */

            $table->decimal('fixed_hourly_amount', 12, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Different Rates
            |--------------------------------------------------------------------------
            |
            | Schools may pay different overtime rates for:
            | Working Day
            | Weekly Off
            | Holiday
            |
            */

            $table->decimal('working_day_multiplier', 5, 2)
                ->default(1.00);

            $table->decimal('weekly_off_multiplier', 5, 2)
                ->default(1.50);

            $table->decimal('holiday_multiplier', 5, 2)
                ->default(2.00);


            /*
            |--------------------------------------------------------------------------
            | Break Handling
            |--------------------------------------------------------------------------
            */

            $table->boolean('exclude_break_time')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Late Adjustment
            |--------------------------------------------------------------------------
            |
            | Whether late arrival should reduce overtime eligibility.
            |
            */

            $table->boolean('adjust_late_minutes')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Early Exit Adjustment
            |--------------------------------------------------------------------------
            */

            $table->boolean('adjust_early_exit_minutes')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Effective Dates
            |--------------------------------------------------------------------------
            */

            $table->date('effective_from')
                ->nullable();

            $table->date('effective_to')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Description
            |--------------------------------------------------------------------------
            */

            $table->text('description')
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

            $table->unique([
                'school_id',
                'rule_code'
            ]);

            $table->index('branch_id');

            $table->index('is_active');

            $table->index([
                'effective_from',
                'effective_to'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('overtime_rules');
    }
};