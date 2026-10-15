<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_deduction_assignments', function (Blueprint $table) {

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
            | Deduction Master
            |--------------------------------------------------------------------------
            */

            $table->foreignId('deduction_id')
                ->constrained('deductions')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Assignment Number
            |--------------------------------------------------------------------------
            */

            $table->string('assignment_number', 50);


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
            | Employee Specific Override
            |--------------------------------------------------------------------------
            */

            $table->decimal('fixed_amount', 15, 2)
                ->nullable();

            $table->decimal('percentage', 8, 4)
                ->nullable();

            $table->text('formula')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Loan / Advance Recovery
            |--------------------------------------------------------------------------
            */

            $table->decimal('total_amount', 15, 2)
                ->nullable();

            $table->decimal('recovered_amount', 15, 2)
                ->default(0);

            $table->decimal('remaining_amount', 15, 2)
                ->nullable();

            $table->decimal('installment_amount', 15, 2)
                ->nullable();

            $table->unsignedInteger('total_installments')
                ->nullable();

            $table->unsignedInteger('completed_installments')
                ->default(0);

            $table->unsignedInteger('remaining_installments')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Recovery
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('recovery_mode')
                ->default(1);

            /*
             * 1 = Monthly
             * 2 = Weekly
             * 3 = Daily
             * 4 = One Time
             */

            $table->date('first_recovery_date')
                ->nullable();

            $table->date('last_recovery_date')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Priority
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('priority')
                ->default(1);


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('status')
                ->default(1);

            /*
             * 1 = Active
             * 2 = Paused
             * 3 = Completed
             * 4 = Cancelled
             * 5 = Expired
             */


            /*
            |--------------------------------------------------------------------------
            | Approval
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('approval_status')
                ->default(1);

            /*
             * 1 = Draft
             * 2 = Pending
             * 3 = Approved
             * 4 = Rejected
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

            $table->unique('assignment_number');

            $table->index('employee_id');
            $table->index('deduction_id');

            $table->index([
                'employee_id',
                'effective_from'
            ]);

            $table->index([
                'employee_id',
                'effective_to'
            ]);

            $table->index('status');
            $table->index('approval_status');
            $table->index('priority');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_deduction_assignments');
    }
};