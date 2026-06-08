<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('transport_assign_vehicles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transport_vehicle_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('transport_route_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('shift')->nullable();
            // Morning / Evening

            $table->date('assign_date')->nullable();

            $table->text('remarks')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_assign_vehicles');
    }
};
