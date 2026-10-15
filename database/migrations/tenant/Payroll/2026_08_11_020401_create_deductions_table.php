<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deductions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Multi School
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
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $table->string('deduction_code', 50);

            $table->string('deduction_name', 150);

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Deduction Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('deduction_type');

            /*
             * 1 = Statutory
             * 2 = Loan
             * 3 = Advance Recovery
             * 4 = Attendance / LOP
             * 5 = Tax
             * 6 = Other
             */


            /*
            |--------------------------------------------------------------------------
            | Calculation Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('calculation_type');

            /*
             * 1 = Fixed
             * 2 = Percentage
             * 3 = Formula
             * 4 = Slab
             */


            /*
            |--------------------------------------------------------------------------
            | Calculation Base
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('calculation_base')
                ->nullable();

            /*
             * 1 = Basic
             * 2 = Gross
             * 3 = Basic + DA
             * 4 = CTC
             * 5 = Net Salary
             * 6 = Custom
             */


            /*
            |--------------------------------------------------------------------------
            | Default Calculation
            |--------------------------------------------------------------------------
            */

            $table->decimal('amount', 15, 2)
                ->nullable();

            $table->decimal('percentage', 8, 4)
                ->nullable();

            $table->text('formula')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Statutory
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_statutory')
                ->default(false);

            $table->string('statutory_code', 50)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Payroll Treatment
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_pre_tax')
                ->default(false);

            $table->boolean('is_post_tax')
                ->default(true);

            $table->boolean('affects_net_salary')
                ->default(true);

            $table->boolean('is_proratable')
                ->default(false);

            $table->boolean('is_affected_by_lop')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Limits
            |--------------------------------------------------------------------------
            */

            $table->decimal('minimum_amount', 15, 2)
                ->nullable();

            $table->decimal('maximum_amount', 15, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Frequency
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('frequency')
                ->default(1);

            /*
             * 1 = Monthly
             * 2 = Weekly
             * 3 = Daily
             * 4 = One Time
             */


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
                'deduction_code'
            ]);

            $table->index('school_id');
            $table->index('branch_id');

            $table->index('deduction_type');
            $table->index('calculation_type');
            $table->index('calculation_base');

            $table->index('is_statutory');
            $table->index('statutory_code');

            $table->index('frequency');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deductions');
    }
};