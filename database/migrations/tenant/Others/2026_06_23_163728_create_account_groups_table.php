<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('account_groups', function (Blueprint $table) {
            $table->id();


            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('account_groups')
                ->nullOnDelete();

            $table->string('name');

            $table->enum('nature', [
                'Asset',
                'Liability',
                'Income',
                'Expense'
            ]);


            $table->integer('level')->default(0);

            $table->boolean('affects_gross_profit')->default(false);

            $table->integer('sort_order')->default(0);

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('session_id')->nullable();
            
            $table->unsignedBigInteger('school_id')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_groups');
    }
};
