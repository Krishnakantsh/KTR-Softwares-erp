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
        Schema::create('tax_masters', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->decimal('percentage', 8, 2);

            $table->enum('type', [
                'GST',
                'CGST',
                'SGST',
                'IGST',
                'TDS'
            ]);

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_masters');
    }
};
