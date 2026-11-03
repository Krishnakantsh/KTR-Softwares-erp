<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_setting_masters', function (Blueprint $table) {
            $table->id();
            $table->string('setting_title', 255);
            $table->string('setting_key', 255);
            $table->tinyInteger('setting_type');
            $table->json('options')->nullable();
            $table->string('default_setting', 255);
            $table->boolean('in_admin_hand')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreignId('module_id')
                ->constrained('modules_masters')
                ->onDelete('restrict');

            $table->foreignId('sub_module_id')
                ->constrained('sub_modules_masters')
                ->onDelete('restrict');

            $table->unique(['setting_key', 'module_id', 'sub_module_id'], 'uq_setting_key');
            $table->index('module_id', 'idx_module');
            $table->index('sub_module_id', 'idx_sub_module');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_setting_masters');
    }
};
