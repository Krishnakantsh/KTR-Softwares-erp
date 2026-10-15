<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_regularizations', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Request Number
            |--------------------------------------------------------------------------
            */

            $table->string('request_number', 60);


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
            | Attendance
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_attendance_id')
                ->nullable()
                ->constrained('employee_attendance')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Attendance Date
            |--------------------------------------------------------------------------
            */

            $table->date('attendance_date');


            /*
            |--------------------------------------------------------------------------
            | Regularization Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('regularization_type');

            /*
             * 1 = Missing IN
             * 2 = Missing OUT
             * 3 = Wrong IN
             * 4 = Wrong OUT
             * 5 = Full Day Present
             * 6 = Half Day
             * 7 = Absent To Present
             * 8 = Present To Leave
             * 9 = Present To WFH
             * 10 = Present To On Duty
             * 11 = Overtime Correction
             * 12 = Late Correction
             * 13 = Early Exit Correction
             * 14 = Other
             */


            /*
            |--------------------------------------------------------------------------
            | Requested Punch
            |--------------------------------------------------------------------------
            */

            $table->dateTime('requested_in')
                ->nullable();

            $table->dateTime('requested_out')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Existing Punch
            |--------------------------------------------------------------------------
            */

            $table->dateTime('existing_in')
                ->nullable();

            $table->dateTime('existing_out')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Requested Attendance Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('requested_status')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Requested Overtime
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('requested_overtime_minutes')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Reason
            |--------------------------------------------------------------------------
            */

            $table->text('reason');


            /*
            |--------------------------------------------------------------------------
            | Attachment
            |--------------------------------------------------------------------------
            */

            $table->string('attachment')
                ->nullable();

            $table->string('attachment_name')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Applied
            |--------------------------------------------------------------------------
            */

            $table->timestamp('applied_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Approval Status
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


            /*
            |--------------------------------------------------------------------------
            | Approval
            |--------------------------------------------------------------------------
            */
            
            $table->unsignedBigInteger('approved_by')->nullable();  

            $table->timestamp('approved_at')
                ->nullable();

            $table->text('approval_remarks')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Rejection
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('rejected_by')->nullable();

            $table->timestamp('rejected_at')
                ->nullable();

            $table->text('rejection_reason')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Cancellation
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('cancelled_by')->nullable();
       

            $table->timestamp('cancelled_at')
                ->nullable();

            $table->text('cancellation_reason')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Processing
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_processed')
                ->default(false);

            $table->timestamp('processed_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Source
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('source')
                ->default(1);

            /*
             * 1 = Employee
             * 2 = Manager
             * 3 = HR
             * 4 = Admin
             * 5 = System
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

            $table->unique('request_number');

            $table->index('employee_id');
            $table->index('employee_attendance_id');

            $table->index('attendance_date');

            $table->index([
                'employee_id',
                'attendance_date'
            ]);

            $table->index('regularization_type');
            $table->index('approval_status');

            $table->index('is_processed');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_regularizations');
    }
};
