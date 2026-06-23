<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('card_template_elements', function (Blueprint $table) {

            $table->id();

            $table->foreignId('card_template_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('side', [
                'front',
                'back'
            ]);

            $table->string('element_name');

            $table->string('element_type');

            $table->longText('element_value')->nullable();

            $table->integer('x')->default(0);

            $table->integer('y')->default(0);

            $table->integer('width')->nullable();

            $table->integer('height')->nullable();

            $table->integer('rotation')->default(0);

            $table->integer('z_index')->default(1);

            $table->string('font_family')->nullable();

            $table->integer('font_size')->nullable();

            $table->integer('font_weight')->nullable();

            $table->string('text_color')->nullable();

            $table->string('background_color')->nullable();

            $table->string('text_align')->nullable();

            $table->boolean('is_locked')->default(false);

            $table->boolean('is_hidden')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('card_template_elements');
    }
};
