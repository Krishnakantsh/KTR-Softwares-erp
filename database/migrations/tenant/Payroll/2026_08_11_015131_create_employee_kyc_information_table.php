<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_kyc_informations', function (Blueprint $table) {

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
            | Aadhaar
            |--------------------------------------------------------------------------
            */

            $table->string('aadhaar_number', 20)
                ->nullable();

            $table->boolean('aadhaar_verified')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | PAN
            |--------------------------------------------------------------------------
            */

            $table->string('pan_number', 20)
                ->nullable();

            $table->boolean('pan_verified')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Passport
            |--------------------------------------------------------------------------
            */

            $table->string('passport_number', 30)
                ->nullable();

            $table->date('passport_issue_date')
                ->nullable();

            $table->date('passport_expiry_date')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Voter ID
            |--------------------------------------------------------------------------
            */

            $table->string('voter_id', 50)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Driving License
            |--------------------------------------------------------------------------
            */

            $table->string('driving_license_number', 50)
                ->nullable();

            $table->date('driving_license_expiry_date')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Other Identity
            |--------------------------------------------------------------------------
            */

            $table->string('nationality', 100)
                ->default('Indian');

            $table->string('religion', 100)
                ->nullable();

            $table->string('category', 100)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Tax / Statutory
            |--------------------------------------------------------------------------
            */

            $table->string('uan_number', 50)
                ->nullable();

            $table->string('pf_number', 50)
                ->nullable();

            $table->string('esic_number', 50)
                ->nullable();

            $table->string('tan_number', 50)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Verification
            |--------------------------------------------------------------------------
            */

            $table->boolean('kyc_verified')
                ->default(false);

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
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('status')
                ->default(true);


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

            $table->unique('employee_id');

            $table->index('aadhaar_number');
            $table->index('pan_number');
            $table->index('uan_number');
            $table->index('pf_number');
            $table->index('esic_number');
            $table->index('kyc_verified');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_kyc_informations');
    }
};