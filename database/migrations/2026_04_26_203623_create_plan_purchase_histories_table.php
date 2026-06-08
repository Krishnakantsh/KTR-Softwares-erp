<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('plan_purchase_histories', function (Blueprint $table) {
            $table->id();
            $table->date('purchase_date');
            $table->date('expires_at');
            $table->date('renewed_at')->nullable();
            $table->integer('grace_period')->default(3);
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreignId('plan_id')->constrained('plans')->cascadeOnDelete();
            $table->foreignId('school_id')->constrained('schools')->cascadeOnDelete();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('plan_purchase_histories');
    }
};
