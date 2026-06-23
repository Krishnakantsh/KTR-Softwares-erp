<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('library_fines', function (Blueprint $table) {
            $table->id();

             $table->unsignedBigInteger('school_id')->nullable();
            $table->unsignedBigInteger('session_id');

            $table->decimal('fine_amount', 10, 2);

            $table->integer('fine_duration');

            $table->enum('duration_type', [
                'day',
                'week',
                'month'
            ]);

            $table->decimal('gst_percentage', 5, 2)->default(0);

            $table->text('remarks')->nullable();
         


            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('library_fines');
    }
};
