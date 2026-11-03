
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_communications', function (Blueprint $table) {
            $table->id();

            // Task reference
            $table->foreignId('task_id')
                ->constrained('project_tasks')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Sender reference
            // Sender reference
            $table->unsignedBigInteger('user_id')->index();

            // Message content
            $table->longText('message')->nullable();

            // Attachment details
            $table->string('file_path', 2048)->nullable();
            $table->string('file_name', 255)->nullable();
            $table->string('file_type', 150)->nullable();
            $table->unsignedBigInteger('file_size')->nullable();

            // Sender details snapshot
            $table->string('user_name', 150)->nullable();
            $table->string('user_profile', 2048)->nullable();

            // Audit fields
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['task_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_communications');
    }
};
