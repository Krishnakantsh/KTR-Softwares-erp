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
        Schema::create('bank_reconciliations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_ledger_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('statement_date');

            $table->decimal('book_balance', 15, 2);

            $table->decimal('bank_balance', 15, 2);

            $table->decimal('difference', 15, 2)->default(0);

            $table->enum('status', [
                'Pending',
                'Reconciled'
            ])->default('Pending');

            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_reconciliations');
    }
};
