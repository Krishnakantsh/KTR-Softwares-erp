<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_structure_components', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Salary Structure
            |--------------------------------------------------------------------------
            */

            $table->foreignId('salary_structure_id')
                ->constrained('salary_structures')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Allowance / Deduction Master
            |--------------------------------------------------------------------------
            */

            $table->foreignId('allowance_id')
                ->nullable()
                ->constrained('allowances')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Component Information
            |--------------------------------------------------------------------------
            */

            $table->string('component_code', 50);

            $table->string('component_name', 150);


            /*
            |--------------------------------------------------------------------------
            | Component Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('component_type');

            /*
             * 1 = Earning
             * 2 = Deduction
             */


            /*
            |--------------------------------------------------------------------------
            | Calculation Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('calculation_type');

            /*
             * 1 = Fixed Amount
             * 2 = Percentage
             * 3 = Formula
             */


            /*
            |--------------------------------------------------------------------------
            | Calculation Base
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('calculation_base')
                ->nullable();

            /*
             * 1  = Basic
             * 2  = Gross
             * 3  = Basic + DA
             * 4  = CTC
             * 5  = Net Salary
             * 6  = Working Days
             * 7  = Present Days
             * 8  = Custom Component
             */


            /*
            |--------------------------------------------------------------------------
            | Value
            |--------------------------------------------------------------------------
            */

            $table->decimal('amount', 15, 2)
                ->nullable();

            $table->decimal('percentage', 8, 4)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Formula
            |--------------------------------------------------------------------------
            */

            $table->text('formula')
                ->nullable();


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
            | Payroll Treatment
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_taxable')
                ->default(true);

            $table->boolean('is_part_of_gross')
                ->default(true);

            $table->boolean('is_part_of_ctc')
                ->default(false);

            $table->boolean('is_part_of_net_salary')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Statutory Configuration
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_pf_applicable')
                ->default(false);

            $table->boolean('is_esi_applicable')
                ->default(false);

            $table->boolean('is_pt_applicable')
                ->default(false);

            $table->boolean('is_tds_applicable')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Arrear / Proration
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_proratable')
                ->default(true);

            $table->boolean('is_affected_by_lop')
                ->default(true);

            $table->boolean('is_affected_by_attendance')
                ->default(true);

            $table->boolean('is_eligible_for_arrear')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Calculation Order
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('calculation_order')
                ->default(1);


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
            | Rounding
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('rounding_method')
                ->default(1);

            /*
             * 1 = Normal
             * 2 = Round Up
             * 3 = Round Down
             */


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

            $table->index('salary_structure_id');
            $table->index('allowance_id');

            $table->index('component_type');
            $table->index('calculation_type');
            $table->index('calculation_base');

            $table->index('is_taxable');
            $table->index('is_pf_applicable');
            $table->index('is_esi_applicable');

            $table->index('calculation_order');
            $table->index('is_active');


            /*
            |--------------------------------------------------------------------------
            | Unique Component
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'salary_structure_id',
                'component_code'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_structure_components');
    }
};