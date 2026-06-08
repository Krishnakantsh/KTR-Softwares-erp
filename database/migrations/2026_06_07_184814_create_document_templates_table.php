<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('document_templates', function (Blueprint $table) {
            $table->id();

            // Multi School Support
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('session_id');

            // Category
            $table->foreignId('document_category_id')
                ->constrained('document_categories')
                ->cascadeOnDelete();

            // Template Info
            $table->string('template_name', 255);

            $table->string('template_code', 100)
                ->nullable();

            $table->text('description')
                ->nullable();

            // Page Settings
            $table->enum('orientation', [
                'portrait',
                'landscape'
            ])->default('portrait');

            $table->enum('page_size', [
                'A4',
                'A5',
                'A6',
                'LETTER',
                'LEGAL',
                'ID_CARD',
                'CUSTOM'
            ])->default('A4');

            // Custom Dimensions
            $table->decimal('width', 8, 2)
                ->nullable();

            $table->decimal('height', 8, 2)
                ->nullable();

            // Assets
            $table->string('background_image')
                ->nullable();

            $table->string('header_image')
                ->nullable();

            $table->string('footer_image')
                ->nullable();

            $table->string('watermark_image')
                ->nullable();

            // Template Content
            $table->longText('html_content')
                ->nullable();

            $table->longText('css_content')
                ->nullable();

            $table->longText('js_content')
                ->nullable();

            // PDF Settings
            $table->boolean('show_header')
                ->default(true);

            $table->boolean('show_footer')
                ->default(true);

            $table->boolean('show_page_number')
                ->default(false);

            // Default Template
            $table->boolean('is_default')
                ->default(false);

            // Active / Inactive
            $table->boolean('status')
                ->default(true);

            // Audit
            $table->unsignedBigInteger('created_by')
                ->nullable();

            $table->unsignedBigInteger('updated_by')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('school_id');
            $table->index('session_id');
            $table->index('status');
            $table->index('is_default');

            $table->index([
                'school_id',
                'session_id',
                'document_category_id'
            ], 'document_template_lookup');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_templates');
    }
};
