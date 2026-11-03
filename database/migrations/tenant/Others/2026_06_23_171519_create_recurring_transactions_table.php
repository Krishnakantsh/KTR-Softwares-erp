<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('recurring_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voucher_type_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('frequency', [
                'Daily',
                'Weekly',
                'Monthly',
                'Yearly'
            ]);

            $table->date('next_run');

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recurring_transactions');
    }
};
