<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_structures', function (Blueprint $table) {

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
            | Basic Information
            |--------------------------------------------------------------------------
            */

            $table->string('structure_code', 50);

            $table->string('structure_name', 150);

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Salary Calculation
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('salary_basis')
                ->default(1);

            /*
             * 1 = Monthly
             * 2 = Daily
             * 3 = Hourly
             */

            $table->unsignedTinyInteger('calculation_type')
                ->default(1);

            /*
             * 1 = Fixed
             * 2 = Component Based
             * 3 = Formula Based
             */


            /*
            |--------------------------------------------------------------------------
            | Effective Period
            |--------------------------------------------------------------------------
            */

            $table->date('effective_from');

            $table->date('effective_to')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Payroll Configuration
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_taxable')
                ->default(true);

            $table->boolean('is_pf_applicable')
                ->default(false);

            $table->boolean('is_esi_applicable')
                ->default(false);

            $table->boolean('is_active')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('status')
                ->default(1);

            /*
             * 1 = Draft
             * 2 = Active
             * 3 = Inactive
             * 4 = Archived
             */


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
                'structure_code'
            ]);

            $table->index('school_id');
            $table->index('branch_id');
            $table->index('effective_from');
            $table->index('effective_to');
            $table->index('status');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_structures');
    }
};