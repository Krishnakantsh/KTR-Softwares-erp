<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();

            // Basic Info
            $table->string('long_logo')->nullable();
            $table->string('board_logo')->nullable();
            $table->string('principal_sign')->nullable();
            $table->string('vice_president_sign')->nullable();
            $table->string('head_mistress')->nullable();
            $table->string('manager_sign')->nullable();
            $table->string('exam_incharge_sign')->nullable();
            $table->string('school_stamp')->nullable();
            $table->string('fees_qr_code')->nullable();
            $table->string('report_card_header_mage')->nullable();
            $table->string('header_image')->nullable();
            $table->string('small_logo')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();

            $table->string('name')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('app_fee_url')->nullable();
            $table->string('app_window_url')->nullable();
            $table->string('app_android_url')->nullable();
            $table->string('app_ios_url')->nullable();
            $table->string('name')->nullable();
            $table->datetime('adm_start')->nullable();
            $table->datetime('adm_end')->nullable();
            $table->string('school_code', 50)->nullable();
            $table->string('board', 100)->nullable();

            // Contact Info
            $table->string('phone', 20)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('website', 150)->nullable();


            $table->text('address')->nullable();
            $table->text('longitude')->nullable();
            $table->text('latitude')->nullable();
            $table->integer('range')->nullable();
            $table->string('udies_no')->nullable();
            $table->string('affli_no')->nullable();
            $table->enum('category',['Private', 'Government','Minority','Independant'])->default('Private');
            $table->enum('type',['Primary', 'Upper Primary','Secondary','Senior Secondary','Higher Secondary','Women'])->default('Senior Secondary');
       
            $table->string('city', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('pincode', 10)->nullable();

            // Branding
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();


            $table->string('principal_name', 150)->nullable();
            $table->string('tc_title', 150)->nullable();
            $table->string('fee_receipt_note', 150)->nullable();
            $table->string('tagline1', 150)->nullable();
            $table->string('tagline2', 20)->nullable();

            $table->string('medium', 50)->nullable();
            $table->boolean('status')->default(true);

            $table->softDeletes();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
