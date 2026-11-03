<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_fine_masters', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();

            $table->string('fine_name', 100);

            $table->string('fine_code', 30)->nullable();

            /*
            |--------------------------------------------------------------------------
            | Fine Type
            |--------------------------------------------------------------------------
            | 1 = Fixed
            | 2 = Per Day
            | 3 = Monthly (Matrix) -- period-based rows across the year, each row
            |     has a separate fine_amount per target/installment month
            |     (stored in fee_fine_rule_amounts)
            */

            $table->tinyInteger('fine_type')->default(1);

            /*
            |--------------------------------------------------------------------------
            | Grace Days
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('grace_days')->default(0);

            /*
            |--------------------------------------------------------------------------
            | Period Days
            |--------------------------------------------------------------------------
            | Sirf fine_type = 3 (Monthly) ke liye. Yeh woh chunk-size (din) hai
            | jisse har month ko rows mein todte hain (e.g. 15 => 1-15, 16-30,
            | 31-31 ...). Edit ke waqt rows dobara isi value se regenerate hote hain.
            */

            $table->unsignedSmallInteger('period_days')->nullable();

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique(
                ['school_id', 'fine_name'],
                'uq_fee_fine'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_fine_masters');
    }
};