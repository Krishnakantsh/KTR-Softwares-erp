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
        Schema::create('designations', function (Blueprint $table) {

            $table->id();

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('branch_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('department_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('designation_name', 150);
            $table->string('designation_code', 30);

            $table->unsignedInteger('hierarchy_level')->default(1);

            $table->text('description')->nullable();

            $table->boolean('is_teaching_staff')->default(false);
            $table->boolean('status')->default(true);

            // Audit
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['department_id', 'designation_code']);
            $table->unique(['department_id', 'designation_name']);

            $table->index('school_id');
            $table->index('branch_id');
            $table->index('department_id');
            $table->index('hierarchy_level');
            $table->index('is_teaching_staff');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
