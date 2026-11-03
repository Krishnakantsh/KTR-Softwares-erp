<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('fee_heads', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->foreignId('fee_group_id')
                ->constrained('fee_groups')
                ->cascadeOnDelete();

            $table->string('head_name', 100);

            $table->string('head_code', 30)->nullable();

            $table->integer('display_order')->default(0);

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();
            
            $table->softDeletes();

            $table->unique(
                ['school_id', 'head_name'],
                'uq_fee_head_name'
            );

            $table->unique(
                ['school_id', 'head_code'],
                'uq_fee_head_code'
            );

            $table->index('fee_group_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_heads');
    }
};
