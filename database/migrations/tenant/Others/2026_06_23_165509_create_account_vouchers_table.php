<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('account_vouchers', function (Blueprint $table) {

            $table->id();

            $table->foreignId('financial_year_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('voucher_type_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('cost_center_id')
                ->nullable()
                ->constrained('account_cost_centers')
                ->nullOnDelete();

            $table->string('voucher_no')->unique();

            $table->date('voucher_date');

            $table->string('reference_no')->nullable();

            $table->text('narration')->nullable();

            $table->decimal('total_amount', 15, 2);

            $table->enum('status', [
                'Draft',
                'Approved',
                'Cancelled'
            ])->default('Approved');

            $table->unsignedBigInteger('session_id')->nullable();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('account_vouchers');
    }
};
