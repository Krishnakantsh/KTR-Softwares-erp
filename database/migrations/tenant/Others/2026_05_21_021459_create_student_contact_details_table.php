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
        Schema::create('student_contact_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('present_address')->nullable();

            $table->string('present_city')->nullable();

            $table->string('present_postal_code')->nullable();

            $table->text('permanent_address')->nullable();

            $table->string('permanent_city')->nullable();

            $table->string('permanent_postal_code')->nullable();

            $table->string('post_office')->nullable();

            $table->string('police_station')->nullable();

            $table->string('district')->nullable();

            $table->string('tehsil')->nullable();

            $table->string('birth_place')->nullable();

            $table->string('country')->default('India');

            $table->string('contact_person_phone')->nullable();

            $table->string('contact_person_email')->nullable();

            $table->text('contact_person_address')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_contact_details');
    }
};
