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
        Schema::create('library_purchases', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();
            $table->unsignedBigInteger('session_id');

            $table->foreignId('supplier_id');

            $table->string('invoice_no');

            $table->date('invoice_date');

            $table->decimal('sub_total', 12, 2);

            $table->decimal('discount_amount', 12, 2)->default(0);

            $table->decimal('gst_amount', 12, 2)->default(0);

            $table->decimal('grand_total', 12, 2);

            $table->text('remarks')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('library_purchases');
    }
};
