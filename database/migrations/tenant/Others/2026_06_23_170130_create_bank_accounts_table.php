<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_ledger_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('bank_name');

            $table->string('branch')->nullable();

            $table->string('account_number');

            $table->string('ifsc_code')->nullable();

            $table->string('upi_id')->nullable();

            $table->unsignedBigInteger('session_id')->nullable();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
