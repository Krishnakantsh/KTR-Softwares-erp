<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_transactions', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Transaction Identity
            |--------------------------------------------------------------------------
            */

            $table->string('transaction_number', 60);


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
            | Leave Type
            |--------------------------------------------------------------------------
            */

            $table->foreignId('leave_type_id')
                ->constrained('leave_types')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Leave Assignment
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_leave_assignment_id')
                ->nullable()
                ->constrained('employee_leave_assignments')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Leave Balance
            |--------------------------------------------------------------------------
            */

            $table->foreignId('leave_balance_id')
                ->nullable()
                ->constrained('leave_balances')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Leave Application
            |--------------------------------------------------------------------------
            */

            $table->foreignId('leave_application_id')
                ->nullable()
                ->constrained('leave_applications')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Transaction Date
            |--------------------------------------------------------------------------
            */

            $table->date('transaction_date');


            /*
            |--------------------------------------------------------------------------
            | Transaction Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('transaction_type');

            /*
             * 1  = Opening Balance
             * 2  = Accrual
             * 3  = Carry Forward
             * 4  = Leave Used
             * 5  = Leave Reversal
             * 6  = Adjustment Credit
             * 7  = Adjustment Debit
             * 8  = Encashment
             * 9  = Expiry
             * 10 = LOP
             * 11 = Transfer In
             * 12 = Transfer Out
             * 13 = Correction
             */


            /*
            |--------------------------------------------------------------------------
            | Quantity
            |--------------------------------------------------------------------------
            */

            $table->decimal('quantity', 8, 2);


            /*
            |--------------------------------------------------------------------------
            | Balance Before / After
            |--------------------------------------------------------------------------
            */

            $table->decimal('balance_before', 8, 2)
                ->default(0);

            $table->decimal('balance_after', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Debit / Credit
            |--------------------------------------------------------------------------
            */

            $table->decimal('credit', 8, 2)
                ->default(0);

            $table->decimal('debit', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Reference
            |--------------------------------------------------------------------------
            */

            $table->string('reference_type', 50)
                ->nullable();

            $table->unsignedBigInteger('reference_id')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Payroll Reference
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('payroll_id')
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
            | System Generated
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_system_generated')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Reversal
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_reversal')
                ->default(false);

            $table->foreignId('reversal_of_id')
                ->nullable()
                ->constrained('leave_transactions')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('status')
                ->default(1);

            /*
             * 1 = Posted
             * 2 = Reversed
             * 3 = Cancelled
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

            $table->unique('transaction_number');

            $table->index('employee_id');
            $table->index('leave_type_id');

            $table->index('employee_leave_assignment_id');
            $table->index('leave_balance_id');
            $table->index('leave_application_id');

            $table->index('transaction_date');
            $table->index('transaction_type');

            $table->index([
                'employee_id',
                'leave_type_id',
                'transaction_date'
            ]);

            $table->index([
                'reference_type',
                'reference_id'
            ]);

            $table->index('payroll_id');

            $table->index('status');
            $table->index('is_reversal');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_transactions');
    }
};