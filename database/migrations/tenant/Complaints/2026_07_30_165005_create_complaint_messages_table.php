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
        Schema::create('complaint_messages', function (Blueprint $table) {

            $table->id();

            $table->foreignId('complaint_id')
                ->constrained('complaints')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Message Type
            |--------------------------------------------------------------------------
            |
            | 1 = Comment
            | 2 = Feedback
            | 3 = Internal Note
            |
            */

            $table->tinyInteger('message_type')
                ->default(1)
                ->comment('1=Comment,2=Feedback,3=Internal Note');

            $table->longText('message');

            /*
            |--------------------------------------------------------------------------
            | Sender
            |--------------------------------------------------------------------------
            |
            | 1 = Admin
            | 2 = Staff
            | 3 = Student
            |
            */

            $table->tinyInteger('created_by_type');
            $table->unsignedBigInteger('created_by_id');

            /*
            |--------------------------------------------------------------------------
            | Extra
            |--------------------------------------------------------------------------
            */

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('complaint_id');

            $table->index([
                'created_by_type',
                'created_by_id'
            ]);

            $table->index('message_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_messages');
    }
};