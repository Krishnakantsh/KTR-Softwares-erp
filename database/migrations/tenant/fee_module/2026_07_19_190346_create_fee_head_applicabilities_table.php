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
        Schema::create('fee_head_applicabilities', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->foreignId('fee_head_id')
                ->constrained('fee_heads')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Applicability Key
            |--------------------------------------------------------------------------
            | gender
            | student_type
            | fee_type
            | (Future: category, hostel, transport, etc.)
            |--------------------------------------------------------------------------
            */
            $table->string('applicability_key', 100);

            /*
            |--------------------------------------------------------------------------
            | Applicability Value
            |--------------------------------------------------------------------------
            | gender       => all, boys, girls
            | student_type => all, new, old
            | fee_type     => all, regular, rte, repeater
            |--------------------------------------------------------------------------
            */
            $table->string('applicability_value', 100);

            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->unique(
                [
                    'fee_head_id',
                    'applicability_key',
                    'applicability_value'
                ],
                'uq_fee_head_applicability'
            );

            $table->index(['fee_head_id', 'applicability_key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_head_applicabilities');
    }
};
