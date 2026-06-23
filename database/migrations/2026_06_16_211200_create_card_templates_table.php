<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('card_templates', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->string('template_name');

            $table->string('card_type')->default('library');

            $table->enum('card_size', [
                'cr80',
                'pvc',
                'a4',
                'custom'
            ])->default('cr80');

            $table->integer('width')->nullable();

            $table->integer('height')->nullable();

            $table->string('front_background')->nullable();

            $table->string('back_background')->nullable();

            $table->string('logo')->nullable();

            $table->string('watermark')->nullable();

            $table->string('theme_color')->nullable();

            $table->boolean('is_default')->default(false);

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('card_templates');
    }
};
