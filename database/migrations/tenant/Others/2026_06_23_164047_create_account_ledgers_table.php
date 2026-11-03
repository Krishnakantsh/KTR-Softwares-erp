<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('account_ledgers', function (Blueprint $table) {

            $table->id();

            $table->foreignId('account_group_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('code')->unique();

            $table->string('name');

            $table->decimal('opening_balance', 15, 2)->default(0);

            $table->enum('opening_type', ['Dr', 'Cr'])->default('Dr');

            $table->string('phone')->nullable();

            $table->string('email')->nullable();

            $table->text('address')->nullable();

            $table->string('pan_no')->nullable();

            $table->string('gst_no')->nullable();

            $table->boolean('is_cash')->default(false);

            $table->boolean('is_bank')->default(false);

            $table->boolean('freeze')->default(false);

            $table->text('remarks')->nullable();

            $table->boolean('status')->default(true);
            
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('school_id')->nullable();
        
            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('account_ledgers');
    }
};
