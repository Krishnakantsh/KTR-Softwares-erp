<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transport_routes', function (Blueprint $table) {
            $table->id();

            $table->string('route_name');
            $table->string('route_code')->nullable();

            $table->string('start_point');
            $table->string('end_point');

            $table->decimal('total_distance', 8, 2)->nullable();

            $table->integer('estimated_time')->nullable();

            $table->text('route_description')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_routes');
    }
};
