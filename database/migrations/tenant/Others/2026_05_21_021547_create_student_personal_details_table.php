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
        Schema::create('student_personal_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('nationality')->default('Indian');

            $table->string('religion')->nullable();

            $table->string('category')->nullable();

            $table->string('caste')->nullable();

            $table->string('aadhaar_no')->nullable();

            $table->string('email')->nullable();

            $table->string('apaar_id')->nullable();

            $table->string('passport_no')->nullable();

            $table->string('nic')->nullable();

            $table->string('bpl_card')->nullable();

            $table->string('saral_id')->nullable();

            $table->string('family_id')->nullable();

            $table->string('blood_group')->nullable();

            $table->string('height')->nullable();

            $table->string('weight')->nullable();

            $table->string('mother_tongue')->nullable();

            $table->decimal('donation_amount', 10, 2)->default(0);

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_personal_details');
    }
};
