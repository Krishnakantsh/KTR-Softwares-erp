<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('school_module_settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->tinyInteger('is_active')->default(1);
            $table->tinyInteger('is_disable')->default(0);

            $table->string('txt_color', 250)->nullable();
            $table->string('bg_color', 250)->nullable();


            $table->foreignId('module_id')
                ->constrained('modules_masters')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('school_id')
                ->constrained('all_schools')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();


            $table->unique(['module_id', 'school_id'], 'uniq_module_school');
            $table->index(['school_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_module_settings');
    }
};
