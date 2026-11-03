<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('allowances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('branch_id')
                ->constrained()
                ->cascadeOnDelete();

            // Basic Information
            $table->string('allowance_name', 150);
            $table->string('allowance_code', 50);

            // Earning / Deduction
            $table->unsignedTinyInteger('effect_type')->default(1);

            /*
             * 1 = Earning / Add to Salary
             * 2 = Deduction / Deduct from Salary
             */

            // Calculation
            $table->unsignedTinyInteger('calculation_type')->default(1);

            /*
             * 1 = Fixed Amount
             * 2 = Percentage
             */

            $table->decimal('default_amount', 15, 2)
                ->default(0);

            $table->decimal('default_percentage', 8, 4)
                ->nullable();

            // Percentage Base
            $table->unsignedTinyInteger('percentage_on')->nullable();

            /*
             * 1 = Basic Salary
             * 2 = Gross Salary
             * 3 = Basic + DA
             * 4 = Custom
             */

            // Statutory / Tax
            $table->boolean('is_taxable')->default(true);

            $table->boolean('is_pf_applicable')
                ->default(false);

            $table->boolean('is_esic_applicable')
                ->default(false);

            // Salary Calculation
            $table->boolean('is_prorated')
                ->default(true);

            $table->boolean('is_overtime_applicable')
                ->default(false);

            // Status
            $table->boolean('status')->default(true);

            $table->text('description')->nullable();

            // Audit
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Unique
            $table->unique([
                'branch_id',
                'allowance_code'
            ]);

            $table->unique([
                'branch_id',
                'allowance_name'
            ]);

            // Indexes
            $table->index('school_id');
            $table->index('branch_id');
            $table->index('effect_type');
            $table->index('calculation_type');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('allowances');
    }
};