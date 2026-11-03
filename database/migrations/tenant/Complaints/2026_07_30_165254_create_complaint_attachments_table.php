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
        Schema::create('complaint_attachments', function (Blueprint $table) {

            $table->id();

            $table->foreignId('complaint_id')
                ->constrained('complaints')
                ->cascadeOnDelete();

            $table->foreignId('complaint_message_id')
                ->nullable()
                ->constrained('complaint_messages')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Attachment
            |--------------------------------------------------------------------------
            */

            $table->string('file_name');

            $table->string('original_name');

            $table->string('file_type', 50)->nullable();

            $table->string('file_extension', 20)->nullable();

            $table->unsignedBigInteger('file_size')->nullable();

            $table->string('file_path');

            /*
            |--------------------------------------------------------------------------
            | Uploaded By
            |--------------------------------------------------------------------------
            */

            //1=Admin
            //2=Staff
            //3=Student

            $table->tinyInteger('uploaded_by_type');

            $table->unsignedBigInteger('uploaded_by_id');

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('complaint_id');
            $table->index('complaint_message_id');

            $table->index([
                'uploaded_by_type',
                'uploaded_by_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_attachments');
    }
};
