<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_balances', function (Blueprint $table) {

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
            | Leave Assignment / Policy
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_leave_assignment_id')
                ->nullable()
                ->constrained('employee_leave_assignments')
                ->nullOnDelete();

            $table->foreignId('leave_type_id')
                ->constrained('leave_types')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Balance Period
            |--------------------------------------------------------------------------
            */

            $table->date('period_start');

            $table->date('period_end');


            /*
            |--------------------------------------------------------------------------
            | Opening Balance
            |--------------------------------------------------------------------------
            */

            $table->decimal('opening_balance', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Accrual
            |--------------------------------------------------------------------------
            */

            $table->decimal('accrued', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Carry Forward
            |--------------------------------------------------------------------------
            */

            $table->decimal('carried_forward', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Leave Usage
            |--------------------------------------------------------------------------
            */

            $table->decimal('used', 8, 2)
                ->default(0);

            $table->decimal('pending', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Adjustments
            |--------------------------------------------------------------------------
            */

            $table->decimal('adjustment', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Encashment
            |--------------------------------------------------------------------------
            */

            $table->decimal('encashed', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Expired
            |--------------------------------------------------------------------------
            */

            $table->decimal('expired', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | LOP
            |--------------------------------------------------------------------------
            */

            $table->decimal('lop_days', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Closing Balance
            |--------------------------------------------------------------------------
            */

            $table->decimal('closing_balance', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Negative Balance
            |--------------------------------------------------------------------------
            */

            $table->decimal('negative_balance', 8, 2)
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Last Accrual
            |--------------------------------------------------------------------------
            */

            $table->date('last_accrual_date')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Last Transaction
            |--------------------------------------------------------------------------
            */

            $table->date('last_transaction_date')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('status')
                ->default(1);

            /*
             * 1 = Open
             * 2 = Closed
             * 3 = Locked
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
                'employee_id',
                'leave_type_id',
                'period_start',
                'period_end'
            ]);

            $table->index('employee_id');
            $table->index('employee_leave_assignment_id');
            $table->index('leave_type_id');

            $table->index([
                'employee_id',
                'period_start'
            ]);

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_balances');
    }
};