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
        Schema::create('complaint_watchers', function (Blueprint $table) {

            $table->id();

            $table->foreignId('complaint_id')
                ->constrained('complaints')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Watcher
            |--------------------------------------------------------------------------
            |
            | 1 = Admin
            | 2 = Staff
            | 3 = Student
            |
            */

            $table->tinyInteger('watcher_type');

            $table->unsignedBigInteger('watcher_id');

            /*
            |--------------------------------------------------------------------------
            | Options
            |--------------------------------------------------------------------------
            */

            $table->boolean('can_view')->default(true);

            $table->boolean('can_comment')->default(true);

            $table->boolean('notify')->default(true);

            $table->timestamp('last_seen_at')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('complaint_id');

            $table->index([
                'watcher_type',
                'watcher_id'
            ]);

            $table->unique([
                'complaint_id',
                'watcher_type',
                'watcher_id'
            ], 'complaint_unique_watcher');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_watchers');
    }
};
