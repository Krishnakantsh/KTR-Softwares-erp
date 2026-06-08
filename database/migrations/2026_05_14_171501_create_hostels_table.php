<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hostels', function (Blueprint $table) {

            $table->id();

            $table->string('hostel_name');

            $table->string('hostel_code')->nullable();

            $table->string('warden_name')->nullable();

            $table->string('warden_mobile')->nullable();

            $table->text('address')->nullable();

            $table->integer('total_blocks')->default(0);

            $table->integer('total_rooms')->default(0);

            $table->integer('capacity')->default(0);

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('session_id')->nullable();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hostels');
    }
};
