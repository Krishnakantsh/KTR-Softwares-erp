<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('modules_masters', function (Blueprint $table) {
            $table->id();
            $table->text('module_icon');
            $table->text('module_name');
            $table->integer('module_order')->default(0);
            $table->string('default_txt_color', 250)->nullable();
            $table->string('default_bg_color', 250)->nullable();
            $table->index('module_order');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modules_masters');
    }
};
