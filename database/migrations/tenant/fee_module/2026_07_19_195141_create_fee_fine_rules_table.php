<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_fine_rules', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('fee_fine_master_id');

            /*
            |--------------------------------------------------------------------------
            | Transport Month (reused as generic Month Master)
            |--------------------------------------------------------------------------
            | Row ka "apna" month -- e.g. "April 16-30" row ke liye transport_month_id
            | = April ki id. Sirf fine_type = 3 (Monthly) rows ke liye set hota hai,
            | isliye nullable (Fixed / Per Day rows ke liye null rahega).
            */

            $table->unsignedBigInteger('transport_month_id')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Day Range
            |--------------------------------------------------------------------------
            */

            $table->unsignedSmallInteger('from_day');

            $table->unsignedSmallInteger('to_day');

            /*
            |--------------------------------------------------------------------------
            | Fine Amount
            |--------------------------------------------------------------------------
            | Fixed / Per Day (fine_type 1, 2) ke liye directly yahan set hota hai.
            | Monthly matrix (fine_type = 3) ke liye null rehta hai -- uska amount
            | fee_fine_rule_amounts table mein (per target-month) store hota hai.
            */

            $table->decimal('fine_amount', 10, 2)->nullable();

            $table->integer('display_order')->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();

            // Foreign Keys
            $table->foreign('fee_fine_master_id', 'ffr_ffm_fk')
                ->references('id')
                ->on('fee_fine_masters')
                ->cascadeOnDelete();

            $table->foreign('transport_month_id', 'ffr_tm_fk')
                ->references('id')
                ->on('transport_months')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_fine_rules');
    }
};