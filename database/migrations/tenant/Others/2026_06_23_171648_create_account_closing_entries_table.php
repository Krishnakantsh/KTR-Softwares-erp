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
        Schema::create('account_closing_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_year_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('closing_date');

            $table->decimal('profit_amount', 15, 2)->default(0);

            $table->decimal('loss_amount', 15, 2)->default(0);

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_closing_entries');
    }
};
