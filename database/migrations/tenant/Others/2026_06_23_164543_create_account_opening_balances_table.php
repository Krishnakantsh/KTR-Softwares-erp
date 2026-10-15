<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('account_opening_balances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('financial_year_id')
                ->constrained('academic_sessions')
                ->cascadeOnDelete();

            $table->foreignId('account_ledger_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('amount', 15, 2);

            $table->enum('type', ['Dr', 'Cr']);

            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('account_opening_balances');
    }
};
