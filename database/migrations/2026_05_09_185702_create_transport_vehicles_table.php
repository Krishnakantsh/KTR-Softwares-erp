<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transport_vehicles', function (Blueprint $table) {
            $table->id();

            $table->string('vehicle_name');
            $table->string('vehicle_number')->unique();

            $table->string('vehicle_type')->nullable();
            // Bus / Van / Auto / Mini Bus

            $table->string('driver_name');
            $table->string('driver_phone');

            $table->string('conductor_name')->nullable();
            $table->string('conductor_phone')->nullable();

            $table->integer('seat_capacity')->default(0);

            $table->string('insurance_number')->nullable();
            $table->date('insurance_expiry')->nullable();

            $table->string('pollution_number')->nullable();
            $table->date('pollution_expiry')->nullable();

            $table->string('fitness_certificate')->nullable();
            $table->date('fitness_expiry')->nullable();

            $table->string('rc_number')->nullable();

            $table->decimal('monthly_maintenance_cost', 10, 2)->default(0);

            $table->text('notes')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_vehicles');
    }
};
