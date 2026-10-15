<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sms_templates', function (Blueprint $table) {
            $table->id();
            $table->string('template_id')->nullable();
            $table->string('template_title')->nullable();
            $table->foreignId('template_typeId')->nullable()->constrained('sms_template_types')->cascadeOnDelete();
            $table->string('template_language')->nullable();
            $table->string('template_company')->nullable();
            $table->string('template_senderId')->nullable();
            $table->text('sms')->nullable();
            $table->enum('status', ['permanent', 'temporary'])->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_templates');
    }
};
