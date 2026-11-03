
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->char('uuid', 36)->nullable()->unique();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->string('name', 200)->nullable();
            $table->string('project_key', 30)->nullable();
            $table->string('slug', 220)->nullable();
            $table->longText('description')->nullable();

            $table->string('project_type', 30)->nullable();
            $table->string('status', 30)->nullable();
            $table->string('priority', 20)->nullable();

            $table->string('owner', 20)->nullable();

            $table->unsignedBigInteger('project_manager_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();

            $table->date('start_date')->nullable();
            $table->date('target_end_date')->nullable();
            $table->dateTime('actual_start_at')->nullable();
            $table->dateTime('completed_at')->nullable();

            $table->decimal('budget_amount', 15, 2)->nullable();
            $table->char('currency_code', 3)->nullable();

            $table->unsignedTinyInteger('progress_percent')->nullable();
            $table->string('visibility', 20)->nullable();

            $table->json('settings')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(
                ['school_id', 'project_key'],
                'uq_projects_key'
            );

            $table->index(
                ['school_id', 'status', 'deleted_at'],
                'idx_projects_school_status'
            );

            $table->index(
                ['school_id', 'start_date', 'target_end_date'],
                'idx_projects_dates'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
