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
        Schema::create('departments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('branch_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('department_name', 150);
            $table->string('department_code', 30);

            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();

            $table->unsignedBigInteger('department_head_id')->nullable();

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            // Audit
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['branch_id', 'department_code']);
            $table->unique(['branch_id', 'department_name']);

            $table->index('school_id');
            $table->index('branch_id');
            $table->index('department_head_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
