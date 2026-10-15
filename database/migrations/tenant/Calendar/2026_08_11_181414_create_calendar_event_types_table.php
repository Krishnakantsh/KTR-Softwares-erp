<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calendar_event_types', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->string('name');
            $table->string('slug');
            $table->string('color')->nullable();
            $table->string('icon')->nullable();

            $table->text('description')->nullable();

            $table->boolean('is_holiday')->default(false);
            $table->boolean('is_active')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['school_id', 'slug']);
            $table->index(['school_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calendar_event_types');
    }
};
