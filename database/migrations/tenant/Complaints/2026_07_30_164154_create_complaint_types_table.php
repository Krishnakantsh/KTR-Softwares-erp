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
        Schema::create('complaint_types', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            // 1 = Admin
            // 2 = Staff
            // 3 = Student
            $table->tinyInteger('complaint_for')
                ->comment('1=Admin,2=Staff,3=Student');

            $table->string('type_name', 100);

            $table->string('description')->nullable();

            // Default Priority
            // 1 Low
            // 2 Medium
            // 3 High
            // 4 Critical
            $table->tinyInteger('default_priority')
                ->default(2)
                ->comment('1=Low,2=Medium,3=High,4=Critical');

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->softDeletes();

            $table->index('school_id');
            $table->index('complaint_for');
            $table->index('status');

            $table->unique([
                'school_id',
                'complaint_for',
                'type_name'
            ], 'complaint_type_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_types');
    }
};
