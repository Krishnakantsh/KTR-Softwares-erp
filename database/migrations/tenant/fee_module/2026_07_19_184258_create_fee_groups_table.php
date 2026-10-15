<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_groups', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->string('group_name', 100);

            $table->string('group_code', 30)->nullable();

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();
            
            $table->softDeletes();

            $table->unique(
                ['school_id', 'group_name'],
                'uq_fee_group_name'
            );

            $table->unique(
                ['school_id', 'group_code'],
                'uq_fee_group_code'
            );

            $table->index('school_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_groups');
    }
};
