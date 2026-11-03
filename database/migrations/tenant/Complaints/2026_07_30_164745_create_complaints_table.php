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
        Schema::create('complaints', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();
            $table->unsignedBigInteger('session_id');

            $table->string('complaint_no', 30)->unique();

            $table->foreignId('complaint_type_id')
                ->constrained('complaint_types')
                ->cascadeOnDelete();

            $table->string('subject', 255);

            $table->longText('description');

            // 1=Low,2=Medium,3=High,4=Critical
            $table->tinyInteger('priority')
                ->default(2)
                ->comment('1=Low,2=Medium,3=High,4=Critical');

            // 1=Open
            // 2=Under Review
            // 3=In Progress
            // 4=Resolved
            // 5=Closed
            // 6=Reopened
            // 7=Rejected
            $table->tinyInteger('status')
                ->default(1)
                ->comment('1=Open,2=Under Review,3=In Progress,4=Resolved,5=Closed,6=Reopened,7=Rejected');

            /*
            |--------------------------------------------------------------------------
            | Raised By
            |--------------------------------------------------------------------------
            */

            //1 Admin
            //2 Staff
            //3 Student

            $table->tinyInteger('raised_by_type');
            $table->unsignedBigInteger('raised_by_id');

            /*
            |--------------------------------------------------------------------------
            | Complaint Against
            |--------------------------------------------------------------------------
            */

            $table->tinyInteger('against_type');
            $table->unsignedBigInteger('against_id');

            /*
            |--------------------------------------------------------------------------
            | Resolution
            |--------------------------------------------------------------------------
            */

            $table->tinyInteger('resolved_by_type')->nullable();
            $table->unsignedBigInteger('resolved_by_id')->nullable();
            $table->timestamp('resolved_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Closed
            |--------------------------------------------------------------------------
            */

            $table->tinyInteger('closed_by_type')->nullable();
            $table->unsignedBigInteger('closed_by_id')->nullable();
            $table->timestamp('closed_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Extra
            |--------------------------------------------------------------------------
            */

            $table->boolean('status_flag')->default(true);

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('school_id');
            $table->index('session_id');

            $table->index('complaint_type_id');

            $table->index([
                'raised_by_type',
                'raised_by_id'
            ]);

            $table->index([
                'against_type',
                'against_id'
            ]);

            $table->index('status');
            $table->index('priority');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
