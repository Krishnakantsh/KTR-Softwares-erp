<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employments', function (Blueprint $table) {
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
            | Organization
            |--------------------------------------------------------------------------
            */

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('branch_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('department_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('designation_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('employment_type_id')
                ->constrained()
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Employee Identity
            |--------------------------------------------------------------------------
            */

            $table->string('employee_code', 50);

            $table->string('employee_number', 50)
                ->nullable();

            /*
             * Biometric / Attendance Identity
             */

            $table->string('biometric_id', 100)
                ->nullable();

            $table->string('attendance_device_user_id', 100)
                ->nullable();

            $table->string('rfid_card_number', 100)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Employment Information
            |--------------------------------------------------------------------------
            */

            $table->date('joining_date');

            $table->date('confirmation_date')
                ->nullable();

            $table->date('probation_start_date')
                ->nullable();

            $table->date('probation_end_date')
                ->nullable();

            $table->date('leaving_date')
                ->nullable();

            $table->unsignedTinyInteger('employment_status')
                ->default(1);

            /*
             * 1 = Active
             * 2 = On Probation
             * 3 = Notice Period
             * 4 = Suspended
             * 5 = Resigned
             * 6 = Terminated
             * 7 = Retired
             * 8 = Left
             */


            /*
            |--------------------------------------------------------------------------
            | Leaving Information
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('leaving_reason')
                ->nullable();

            /*
             * 1 = Resignation
             * 2 = Termination
             * 3 = Retirement
             * 4 = Contract End
             * 5 = Transfer
             * 6 = Other
             */

            $table->text('leaving_remarks')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Reporting
            |--------------------------------------------------------------------------
            */

            $table->foreignId('reporting_manager_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Attendance Configuration
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('attendance_mode')
                ->default(1);

            /*
             * 1 = Manual
             * 2 = Biometric
             * 3 = RFID
             * 4 = Face Recognition
             * 5 = Mobile
             * 6 = Multiple
             */


            /*
            |--------------------------------------------------------------------------
            | Work Configuration
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_attendance_required')
                ->default(true);

            $table->boolean('is_payroll_applicable')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Joining / Exit Documents
            |--------------------------------------------------------------------------
            */

            $table->string('joining_letter')
                ->nullable();

            $table->string('resignation_letter')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('status')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Notes
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
            | Unique Constraints
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'branch_id',
                'employee_code'
            ]);

            $table->unique([
                'branch_id',
                'employee_number'
            ]);


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('school_id');
            $table->index('branch_id');
            $table->index('department_id');
            $table->index('designation_id');
            $table->index('employment_type_id');

            $table->index('biometric_id');
            $table->index('attendance_device_user_id');
            $table->index('rfid_card_number');

            $table->index('joining_date');
            $table->index('leaving_date');
            $table->index('employment_status');

            $table->index('reporting_manager_id');
            $table->index('attendance_mode');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employments');
    }
};
