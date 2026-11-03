
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_tasks', function (Blueprint $table) {
            $table->id();

            // Project reference
            $table->foreignId('project_id')
                ->constrained('projects')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('team_id')
                ->constrained('project_teams')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Task details
            $table->string('task_code', 50)->nullable()->unique();
            $table->string('task_title', 200);
            $table->string('task_slug', 220)->nullable()->index();
            $table->longText('description')->nullable();

            // Assigned staff IDs (JSON array)
            $table->json('staff_ids')->nullable();

            // Task priority
            $table->string('priority', 20)->default('medium');

            // Task workflow status
            $table->string('status', 30)
                ->default('not_started')
                ->index();

            // Task dates
            $table->date('start_date')->nullable();
            $table->date('due_date')->nullable();
            $table->timestamp('completed_at')->nullable();

            // Progress percentage (0-100)
            $table->unsignedTinyInteger('progress')->default(0);

            // Audit fields
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['project_id', 'status']);
            $table->index(['project_id', 'due_date']);
            $table->index(['status', 'priority']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_tasks');
    }
};
