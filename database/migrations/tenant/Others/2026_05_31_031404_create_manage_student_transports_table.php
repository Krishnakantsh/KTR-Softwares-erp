<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_transports', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('student_id');

            $table->unsignedBigInteger('route_id');

            $table->unsignedBigInteger('vehicle_id');

            $table->unsignedBigInteger('destination_id');

            $table->date('apply_date')->nullable();

            $table->boolean('status')->default(true);

            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(
                ['student_id'],
                'student_transport_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_transports');
    }
};
