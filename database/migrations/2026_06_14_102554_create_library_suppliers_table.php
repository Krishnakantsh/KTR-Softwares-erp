<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('library_suppliers', function (Blueprint $table) {
            $table->id();

              $table->unsignedBigInteger('school_id')->nullable();
            $table->unsignedBigInteger('session_id');

            $table->string('supplier_name');
             $table->string('slug')->nullable();


            $table->string('contact_person')->nullable();

            $table->string('mobile')->nullable();

            $table->string('alternate_mobile')->nullable();

            $table->string('email')->nullable();

            $table->string('gst_number')->nullable();

            $table->text('address')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('library_suppliers');
    }
};
