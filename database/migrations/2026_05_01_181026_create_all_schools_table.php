<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('all_schools', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');

            $table->string('db_name')->unique();
            $table->string('db_pass')->nullable();
            $table->string('db_user')->nullable();

            $table->date('start_date')->nullable();
            $table->date('valid_upto')->nullable();
            $table->integer('grace_period')->default(0);

            $table->boolean('is_active')->default(true);

            $table->string('email')->nullable();

            $table->string('phone')->nullable();
            
            $table->softDeletes();
            $table->timestamps();

           
            $table->foreignId('plan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('all_schools');
    }
};
