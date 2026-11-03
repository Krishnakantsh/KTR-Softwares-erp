<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_leave_assignments', function (Blueprint $table) {

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
            | Leave Policy
            |--------------------------------------------------------------------------
            */

            $table->foreignId('leave_policy_id')
                ->constrained('leave_policies')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Assignment
            |--------------------------------------------------------------------------
            */

            $table->string('assignment_number', 50);

            $table->date('effective_from');

            $table->date('effective_to')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Employee Specific Entitlement Override
            |--------------------------------------------------------------------------
            */

            $table->decimal('annual_entitlement', 8, 2)
                ->nullable();

            $table->decimal('monthly_entitlement', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Carry Forward Override
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_carry_forward')
                ->nullable();

            $table->decimal('carry_forward_limit', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Encashment Override
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_encashment')
                ->nullable();

            $table->decimal('encashment_limit', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Negative Balance Override
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_negative_balance')
                ->nullable();

            $table->decimal('negative_balance_limit', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Assignment Priority
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
             * 2 = Suspended
             * 3 = Expired
             * 4 = Cancelled
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
            $table->index('leave_policy_id');

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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_leave_assignments');
    }
};