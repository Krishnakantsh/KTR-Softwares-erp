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
        Schema::create('complaint_status_histories', function (Blueprint $table) {

            $table->id();

            $table->foreignId('complaint_id')
                ->constrained('complaints')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            // 1=Open
            // 2=Under Review
            // 3=In Progress
            // 4=Resolved
            // 5=Closed
            // 6=Reopened
            // 7=Rejected

            $table->tinyInteger('old_status')->nullable();

            $table->tinyInteger('new_status');

            $table->text('remarks')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Changed By
            |--------------------------------------------------------------------------
            */

            //1=Admin
            //2=Staff
            //3=Student

            $table->tinyInteger('changed_by_type');

            $table->unsignedBigInteger('changed_by_id');

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('complaint_id');

            $table->index([
                'changed_by_type',
                'changed_by_id'
            ]);

            $table->index('new_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_status_histories');
    }
};