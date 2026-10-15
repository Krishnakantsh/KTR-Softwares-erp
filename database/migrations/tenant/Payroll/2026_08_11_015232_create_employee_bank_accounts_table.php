<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_bank_accounts', function (Blueprint $table) {

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
            | Bank Information
            |--------------------------------------------------------------------------
            */

            $table->string('account_holder_name', 200);

            $table->string('account_number', 100);

            $table->string('account_type', 30)
                ->default('Savings');

            /*
             * Savings
             * Current
             * Salary
             * Other
             */

            $table->string('bank_name', 200);

            $table->string('branch_name', 200)
                ->nullable();

            $table->string('ifsc_code', 20);

            $table->string('swift_code', 20)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Bank Address
            |--------------------------------------------------------------------------
            */

            $table->string('bank_city', 100)
                ->nullable();

            $table->string('bank_state', 100)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Salary Account
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_primary')
                ->default(false);

            $table->boolean('is_salary_account')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Verification
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('verification_status')
                ->default(1);

            /*
             * 1 = Pending
             * 2 = Verified
             * 3 = Rejected
             */

            $table->foreignId('verified_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('verified_at')
                ->nullable();

            $table->text('verification_remarks')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Cheque / Passbook
            |--------------------------------------------------------------------------
            */

            $table->string('cancelled_cheque')
                ->nullable();

            $table->string('passbook_file')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('status')
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

            $table->index('employee_id');
            $table->index('account_number');
            $table->index('ifsc_code');
            $table->index('verification_status');
            $table->index('is_primary');
            $table->index('is_salary_account');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_bank_accounts');
    }
};