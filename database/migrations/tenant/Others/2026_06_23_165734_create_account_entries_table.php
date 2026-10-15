<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('account_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_voucher_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('account_ledger_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->decimal('debit', 15, 2)->default(0);

            $table->decimal('credit', 15, 2)->default(0);

            $table->text('remarks')->nullable();


            $table->unsignedBigInteger('session_id')->nullable();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_entries');
    }
};
