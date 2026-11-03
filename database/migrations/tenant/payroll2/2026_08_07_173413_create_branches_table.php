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
        Schema::create('branches', function (Blueprint $table) {

            $table->id();

            // School
            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            // Basic Information
            $table->string('branch_code', 30)->unique();
            $table->string('branch_name', 150);
            $table->string('display_name', 150)->nullable();

            // Contact
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('alternate_phone', 20)->nullable();

            // Address
            $table->string('country', 100)->default('India');
            $table->string('state', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('area', 150)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->text('address')->nullable();

            // GPS
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // Branch Head (FK baad me add karna better rahega)
            $table->unsignedBigInteger('branch_head_id')->nullable();

            // Office Timing
            $table->time('office_start_time')->nullable();
            $table->time('office_end_time')->nullable();

            // Academic
            $table->date('opening_date')->nullable();

            // Images
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();

            // Registration
            $table->string('gst_number', 20)->nullable();
            $table->string('registration_number')->nullable();
            $table->string('affiliation_number')->nullable();

            // Status
            $table->boolean('is_head_office')->default(false);
            $table->boolean('is_active')->default(true);

            // Description
            $table->text('description')->nullable();
            
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('school_id');
            $table->index('branch_code');
            $table->index('branch_name');
            $table->index('branch_head_id');
            $table->index('is_active');
            $table->index('is_head_office');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
