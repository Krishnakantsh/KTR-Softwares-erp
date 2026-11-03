<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_types', function (Blueprint $table) {

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

            $table->string('leave_code', 50);

            $table->string('leave_name', 150);

            $table->text('description')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Leave Category
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('leave_category')
                ->default(1);

            /*
             * 1 = Paid
             * 2 = Unpaid
             * 3 = Statutory
             * 4 = Special
             * 5 = Other
             */


            /*
            |--------------------------------------------------------------------------
            | Salary Treatment
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('salary_treatment')
                ->default(1);

            /*
             * 1 = Paid
             * 2 = Unpaid / LOP
             * 3 = Partial Paid
             */


            /*
            |--------------------------------------------------------------------------
            | Attendance Treatment
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('attendance_treatment')
                ->default(1);

            /*
             * 1 = Present
             * 2 = Leave
             * 3 = Absent
             * 4 = Half Day
             */


            /*
            |--------------------------------------------------------------------------
            | Gender Restriction
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('gender_restriction')
                ->default(1);

            /*
             * 1 = All
             * 2 = Male
             * 3 = Female
             * 4 = Other
             */


            /*
            |--------------------------------------------------------------------------
            | Balance Configuration
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_paid')
                ->default(true);

            $table->boolean('requires_approval')
                ->default(true);

            $table->boolean('requires_document')
                ->default(false);

            $table->boolean('allow_half_day')
                ->default(true);

            $table->boolean('allow_hourly')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Carry Forward
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_carry_forward')
                ->default(false);

            $table->decimal('maximum_carry_forward', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Encashment
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_encashment')
                ->default(false);

            $table->decimal('maximum_encashment', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Negative Balance
            |--------------------------------------------------------------------------
            */

            $table->boolean('allow_negative_balance')
                ->default(false);

            $table->decimal('maximum_negative_balance', 8, 2)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Weekend / Holiday
            |--------------------------------------------------------------------------
            */

            $table->boolean('include_weekends')
                ->default(false);

            $table->boolean('include_holidays')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Notice / Restriction
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('minimum_notice_days')
                ->default(0);

            $table->unsignedInteger('maximum_consecutive_days')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);

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

            $table->unique([
                'school_id',
                'leave_code'
            ]);

            $table->index('school_id');
            $table->index('branch_id');

            $table->index('leave_category');
            $table->index('salary_treatment');
            $table->index('attendance_treatment');

            $table->index('is_paid');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};