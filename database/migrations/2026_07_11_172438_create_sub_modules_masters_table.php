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
        Schema::create('sub_modules_masters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        
            $table->text('sub_module_icon');
            $table->text('sub_module_name');
            $table->text('sub_module_url');
            $table->integer('sub_module_order')->default(0);
            $table->tinyInteger('dashboard_permission')->default(0);
            $table->string('eng_video_url')->nullable();
            $table->string('hin_video_url')->nullable();
            $table->string('submodule_sortname');


          

            $table->foreignId('module_id')
                ->constrained('modules_masters')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->index('sub_module_order');
            $table->index(['module_id', 'sub_module_order'], 'idx_submodule_master_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_modules_masters');
    }
};
