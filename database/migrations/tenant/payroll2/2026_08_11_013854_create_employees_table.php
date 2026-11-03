<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {

             $table->id();

            /*
            |--------------------------------------------------------------------------
            | Personal Information
            |--------------------------------------------------------------------------
            */

            $table->string('first_name', 100);

            $table->string('middle_name', 100)
                ->nullable();

            $table->string('last_name', 100)
                ->nullable();

            $table->string('display_name', 200)
                ->nullable();

            $table->unsignedTinyInteger('gender')
                ->nullable();

            /*
             * 1 = Male
             * 2 = Female
             * 3 = Other
             */

            $table->date('date_of_birth')
                ->nullable();

            $table->string('blood_group', 10)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Family Information
            |--------------------------------------------------------------------------
            */

            $table->string('father_name', 200)
                ->nullable();

            $table->string('mother_name', 200)
                ->nullable();

            $table->unsignedTinyInteger('marital_status')
                ->default(1);

            /*
             * 1 = Single
             * 2 = Married
             * 3 = Divorced
             * 4 = Widowed
             * 5 = Separated
             */

            $table->string('spouse_name', 200)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Contact Information
            |--------------------------------------------------------------------------
            */

            $table->string('personal_email')
                ->nullable();

            $table->string('personal_mobile', 20)
                ->nullable();

            $table->string('alternate_mobile', 20)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Emergency Contact
            |--------------------------------------------------------------------------
            */

            $table->string('emergency_contact_name', 200)
                ->nullable();

            $table->string('emergency_contact_relation', 100)
                ->nullable();

            $table->string('emergency_contact_mobile', 20)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Current Address
            |--------------------------------------------------------------------------
            */

            $table->string('current_address_line_1', 255)
                ->nullable();

            $table->string('current_address_line_2', 255)
                ->nullable();

            $table->string('current_country', 100)
                ->default('India');

            $table->string('current_state', 100)
                ->nullable();

            $table->string('current_district', 100)
                ->nullable();

            $table->string('current_city', 100)
                ->nullable();

            $table->string('current_area', 150)
                ->nullable();

            $table->string('current_pincode', 10)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Permanent Address
            |--------------------------------------------------------------------------
            */

            $table->string('permanent_address_line_1', 255)
                ->nullable();

            $table->string('permanent_address_line_2', 255)
                ->nullable();

            $table->string('permanent_country', 100)
                ->default('India');

            $table->string('permanent_state', 100)
                ->nullable();

            $table->string('permanent_district', 100)
                ->nullable();

            $table->string('permanent_city', 100)
                ->nullable();

            $table->string('permanent_area', 150)
                ->nullable();

            $table->string('permanent_pincode', 10)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Address Helper
            |--------------------------------------------------------------------------
            */

            $table->boolean('same_as_permanent_address')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Profile
            |--------------------------------------------------------------------------
            */

            $table->string('profile_photo')
                ->nullable();

            $table->text('notes')
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
            $table->index('first_name');
            $table->index('last_name');
            $table->index('gender');
            $table->index('marital_status');
            $table->index('current_state');
            $table->index('current_city');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
