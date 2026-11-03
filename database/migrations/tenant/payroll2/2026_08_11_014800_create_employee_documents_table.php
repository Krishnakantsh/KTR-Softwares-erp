<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_documents', function (Blueprint $table) {

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
            | Document Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('document_type');

/*
             * 1  = Aadhaar
             * 2  = PAN
             * 3  = Signature
             * 4  = Driving License
             * 5  = Voter ID
             * 6  = Tenth Marksheet
             * 7  = Twelfth Marksheet
             * 8  = Graduation Marksheet
             * 9  = Post-Graduation Marksheet
             * 10 = Contract / Agreement
             * 11 = Medical Certificate
             * 12 = Address Proof
             * 13 = Other
             */


            /*
            |--------------------------------------------------------------------------
            | Document Information
            |--------------------------------------------------------------------------
            */

            $table->string('document_name', 200);

            $table->string('document_number', 150)
                ->nullable();

            $table->string('issuing_authority', 200)
                ->nullable();

            $table->date('issue_date')
                ->nullable();

            $table->date('expiry_date')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | File Information
            |--------------------------------------------------------------------------
            */

            $table->string('file_path', 500);

            $table->string('file_name', 255)
                ->nullable();

            $table->string('file_extension', 20)
                ->nullable();

            $table->unsignedBigInteger('file_size')
                ->nullable();

            $table->string('mime_type', 100)
                ->nullable();


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
            | Document Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_required')
                ->default(false);

            $table->boolean('is_primary')
                ->default(false);

            $table->boolean('status')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Additional Information
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

            $table->index('employee_id');
            $table->index('document_type');
            $table->index('document_number');
            $table->index('verification_status');
            $table->index('expiry_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_documents');
    }
};
