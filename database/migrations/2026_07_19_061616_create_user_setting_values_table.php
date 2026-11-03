<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_setting_values', function (Blueprint $table) {
            $table->id();

            $table->text('selected_setting');

            $table->foreignId('school_id')
                ->constrained('all_schools')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('user_setting_master_id')
                ->constrained('user_setting_masters', 'id')
                ->cascadeOnDelete();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->unique(
                ['user_setting_master_id', 'school_id'],
                'uq_setting_school'
            );

            $table->index('school_id', 'idx_school');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_setting_values');
    }
};
