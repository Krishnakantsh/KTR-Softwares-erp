<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_structures', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->unsignedBigInteger('session_id');

            $table->unsignedBigInteger('class_id');

            $table->unsignedBigInteger('stream_id');

            $table->string('structure_name', 150);

            $table->date('effective_from');

            $table->date('effective_to')->nullable();

            $table->text('remarks')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('session_id', 'fs_ses_fk')
                ->references('id')
                ->on('academic_sessions')
                ->cascadeOnDelete();

            $table->foreign('class_id', 'fs_cls_fk')
                ->references('id')
                ->on('class_masters')
                ->cascadeOnDelete();

                
            $table->foreign('stream_id', 'fs_stm_fk')
                ->references('id')
                ->on('stream_masters')
                ->cascadeOnDelete();

          
            $table->unique(
                ['school_id', 'session_id', 'class_id'],
                'uq_fee_structure'
            );

          
            $table->index(
                ['school_id', 'session_id'],
                'fs_sch_ses_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
