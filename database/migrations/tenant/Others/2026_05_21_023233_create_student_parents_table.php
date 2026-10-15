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
        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('parent_type', [
                'father',
                'mother',
                'guardian'
            ]);

            // Basic Info

            $table->string('name')->nullable();

            $table->date('dob')->nullable();

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            $table->string('aadhaar_no')->nullable();

            $table->string('pan_no')->nullable();

            $table->string('occupation')->nullable();

            $table->string('designation')->nullable();

            $table->string('qualification')->nullable();

            $table->string('department')->nullable();

            $table->decimal('annual_income', 12, 2)
                ->default(0);

            $table->text('address')->nullable();

            $table->string('bpl_card')->nullable();

            // Service Details

            $table->boolean('is_in_service')
                ->default(false);

            // Alive Status

            $table->boolean('is_alive')
                ->default(true);

            // Business Details

            $table->text('business_detail')->nullable();

            $table->string('company_name')->nullable();

            $table->string('office_phone')->nullable();

            $table->string('office_email')->nullable();

            $table->string('office_website')->nullable();

            $table->text('office_address')->nullable();

            $table->string('samagra_id')->nullable();

            $table->text('remark')->nullable();

            $table->boolean('status')->default(true);

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_parents');
    }
};
