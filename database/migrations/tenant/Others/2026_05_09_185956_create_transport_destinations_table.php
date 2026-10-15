<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('transport_destinations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('transport_route_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('destination_name');

            $table->string('pickup_time')->nullable();
            $table->string('drop_time')->nullable();

            $table->integer('stop_order')->default(0);

            $table->decimal('distance_from_school', 8, 2)->nullable();

            $table->decimal('transport_fee', 10, 2)->default(0);

            $table->text('address')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('transport_destinations');
    }
};
