<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_salary_assignments', function (Blueprint $table) {

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
            | Salary Structure
            |--------------------------------------------------------------------------
            */

            $table->foreignId('salary_structure_id')
                ->constrained('salary_structures')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Assignment Identity
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
            | Salary Amount
            |--------------------------------------------------------------------------
            */

            $table->decimal('gross_salary', 15, 2)
                ->nullable();

            $table->decimal('ctc', 15, 2)
                ->nullable();

            $table->decimal('basic_salary', 15, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Revision
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('revision_number')
                ->default(1);

            $table->unsignedTinyInteger('revision_type')
                ->default(1);

            /*
             * 1 = Initial
             * 2 = Increment
             * 3 = Promotion
             * 4 = Demotion
             * 5 = Salary Revision
             * 6 = Transfer
             * 7 = Correction
             * 8 = Other
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
             * 5 = Cancelled
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
            | Assignment Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_current')
                ->default(false);

            $table->boolean('status')
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

            $table->unique('assignment_number');

            $table->index('employee_id');
            $table->index('salary_structure_id');

            $table->index([
                'employee_id',
                'effective_from'
            ]);

            $table->index([
                'employee_id',
                'effective_to'
            ]);

            $table->index('revision_number');
            $table->index('revision_type');
            $table->index('approval_status');
            $table->index('is_current');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_salary_assignments');
    }
};