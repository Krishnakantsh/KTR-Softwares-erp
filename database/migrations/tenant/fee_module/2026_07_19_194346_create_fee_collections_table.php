<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_collections', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->unsignedBigInteger('session_id');

            $table->unsignedBigInteger('student_id');

            $table->string('receipt_no', 50);

            $table->date('receipt_date');

            /*
            |--------------------------------------------------------------------------
            | Payment Mode
            |--------------------------------------------------------------------------
            | 1 = Cash
            | 2 = Cheque
            | 3 = Online
            | 4 = UPI
            | 5 = Card
            | 6 = Bank Transfer
            */

            $table->tinyInteger('payment_mode')->default(1);

            $table->string('transaction_no', 100)->nullable();

            $table->string('bank_name', 100)->nullable();

            $table->decimal('total_amount', 10, 2)->default(0);

            $table->decimal('total_concession', 10, 2)->default(0);

            $table->decimal('total_fine', 10, 2)->default(0);

            $table->decimal('net_amount', 10, 2)->default(0);

            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('received_by');

            $table->boolean('status')->default(true);

            $table->tinyInteger('receipt_status')
                ->default(1)
                ->comment('1=Active,2=Cancelled,3=Refunded');

            $table->timestamps();
            $table->softDeletes();

            // Foreign Keys
            $table->foreign('session_id', 'fc_ses_fk')
                ->references('id')
                ->on('academic_sessions')
                ->cascadeOnDelete();

            $table->foreign('student_id', 'fc_std_fk')
                ->references('id')
                ->on('students')
                ->cascadeOnDelete();

            // Unique
            $table->unique(
                ['school_id', 'session_id', 'receipt_no'],
                'uq_fee_receipt'
            );

            // Index
            $table->index(
                ['school_id', 'session_id', 'student_id'],
                'fc_sch_ses_std_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_collections');
    }
};
