<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('check_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('account_voucher_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('cheque_no');

            $table->date('cheque_date');

            $table->date('clear_date')->nullable();

            $table->enum('status', [
                'Pending',
                'Cleared',
                'Bounce'
            ]);

            $table->unsignedBigInteger('session_id')->nullable();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('check_entries');
    }
};
