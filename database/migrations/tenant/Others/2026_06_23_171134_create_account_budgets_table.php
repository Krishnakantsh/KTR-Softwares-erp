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
        Schema::create('account_budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('financial_year_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('budget_head_id')
                ->constrained('account_budget_heads')
                ->cascadeOnDelete();

            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_budgets');
    }
};
