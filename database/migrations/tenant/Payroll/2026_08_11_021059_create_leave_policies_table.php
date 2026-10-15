<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_policies', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Multi School / Branch
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
            | Leave Type
            |--------------------------------------------------------------------------
            */

            $table->foreignId('leave_type_id')
                ->constrained('leave_types')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Policy Information
            |--------------------------------------------------------------------------
            */

            $table->string('policy_code', 50);

            $table->string('policy_name', 150);

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Policy Period
            |--------------------------------------------------------------------------
            */

            $table->date('effective_from');

            $table->date('effective_to')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Entitlement
            |--------------------------------------------------------------------------
            */

            $table->decimal('annual_entitlement', 8, 2)
                ->default(0);

            $table->decimal('monthly_entitlement', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Accrual
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('accrual_frequency')
                ->default(1);

            /*
             * 1 = Yearly
             * 2 = Monthly
             * 3 = Quarterly
             * 4 = Half Yearly
             */


            $table->unsignedTinyInteger('accrual_method')
                ->default(1);

            /*
             * 1 = Fixed
             * 2 = Monthly Accrual
             * 3 = Pro Rata
             * 4 = Joining Date Based
             */


            /*
            |--------------------------------------------------------------------------
            | Pro Rata
            |--------------------------------------------------------------------------
            */

            $table->boolean('pro_rata_on_joining')
                ->default(false);

            $table->boolean('pro_rata_on_exit')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Accrual Timing
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('accrual_day')
                ->nullable();

            /*
             * Example:
             * 1 = First day of month
             * 15 = 15th
             * 31 = Last day logic handled in service
             */


            $table->boolean('accrue_during_probation')
                ->default(true);

            $table->boolean('accrue_during_notice_period')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Carry Forward
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_carry_forward')
                ->default(false);

            $table->decimal('carry_forward_limit', 8, 2)
                ->nullable();

            $table->unsignedTinyInteger('carry_forward_expiry_type')
                ->default(1);

            /*
             * 1 = Never Expire
             * 2 = End of Financial Year
             * 3 = Fixed Months
             */

            $table->unsignedInteger('carry_forward_expiry_months')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Encashment
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_encashment')
                ->default(false);

            $table->decimal('encashment_limit', 8, 2)
                ->nullable();

            $table->unsignedTinyInteger('encashment_basis')
                ->default(1);

            /*
             * 1 = Basic
             * 2 = Basic + DA
             * 3 = Gross
             */


            /*
            |--------------------------------------------------------------------------
            | Negative Balance
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_negative_balance')
                ->default(false);

            $table->decimal('negative_balance_limit', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Leave Restrictions
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('minimum_service_days')
                ->default(0);

            $table->unsignedInteger('maximum_consecutive_days')
                ->nullable();

            $table->unsignedInteger('minimum_notice_days')
                ->default(0);

            $table->boolean('allow_half_day')
                ->default(true);

            $table->boolean('allow_hourly')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Weekend / Holiday
            |--------------------------------------------------------------------------
            */

            $table->boolean('count_weekends')
                ->default(false);

            $table->boolean('count_holidays')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Sandwich Rule
            |--------------------------------------------------------------------------
            */

            $table->boolean('sandwich_rule')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | LOP
            |--------------------------------------------------------------------------
            */

            $table->boolean('convert_excess_to_lop')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Applicability
            |--------------------------------------------------------------------------
            */

            $table->boolean('applicable_to_all_employees')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);

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

            $table->unique([
                'school_id',
                'policy_code'
            ]);

            $table->index('school_id');
            $table->index('branch_id');
            $table->index('leave_type_id');

            $table->index('effective_from');
            $table->index('effective_to');

            $table->index('accrual_frequency');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_policies');
    }
};