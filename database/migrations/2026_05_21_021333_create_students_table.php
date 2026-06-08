<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('roll_no')->nullable();
            $table->string('comp_no')->nullable();
            $table->boolean('is_Transport_apply')
                ->nullable()
                ->after('is_ews');

            $table->boolean('is_Hostel_apply')
                ->nullable()
                ->after('is_Transport_apply');


            $table->unsignedBigInteger('session_id')->nullable();

            $table->string('sr_no')->nullable();

            $table->string('admission_no');

            $table->string('enroll_no')->nullable();

            $table->string('search_query')->nullable();

            $table->string('permanent_edu_no')->nullable();

            $table->foreignId('class_id')->nullable()->constrained('class_masters')->nullOnDelete();

            $table->foreignId('section_id')->nullable()->constrained('class_sections')->nullOnDelete();

            $table->foreignId('stream_id')->nullable()->constrained('stream_masters')->nullOnDelete();

            $table->foreignId('house_id')->nullable()->constrained()->nullOnDelete();

            $table->string('fee_type')->nullable();

            $table->string('student_type')->default('New');

            $table->string('student_status')->default('Studying');

            $table->date('admission_date')->nullable();

            $table->date('dob')->nullable();

            $table->string('first_name');

            $table->string('last_name')->nullable();

            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();

            $table->string('father_name')->nullable();

            $table->string('mother_name')->nullable();

            $table->string('father_mobile')->nullable();

            $table->string('student_photo')->nullable();

            $table->string('mother_mobile')->nullable();

            $table->string('sms_whatsapp_no')->nullable();

            $table->string('contact_person_name')->nullable();

            $table->string('tc_no')->nullable();
            $table->string('exam_rollno')->nullable();
            $table->string('feebook_no')->nullable();

            $table->string('manual_tc_no')->nullable();

            $table->text('reason')->nullable();

            $table->text('comment')->nullable();

            $table->boolean('is_active')->default(true);

            $table->boolean('is_ews')->default(false);

            $table->boolean('is_study_material')->default(false);

            $table->boolean('is_physically_challenged')->default(false);

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('students');
    }
};
