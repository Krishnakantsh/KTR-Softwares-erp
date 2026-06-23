<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('library_books', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('school_id')->nullable();
            $table->unsignedBigInteger('session_id');

            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('publication_id')->nullable();

            $table->string('book_code')->unique();
            $table->string('slug')->nullable();


            $table->string('accession_no')->nullable();

            $table->string('barcode')->nullable();

            $table->string('book_name');

            $table->string('sub_title')->nullable();

            $table->string('isbn_no')->nullable();

            $table->string('edition')->nullable();

            $table->string('volume')->nullable();

            $table->string('language')->nullable();

            $table->string('rack_no')->nullable();

            $table->string('shelf_no')->nullable();

            $table->string('subject')->nullable();

            $table->string('class_name')->nullable();

            $table->year('publication_year')->nullable();

            $table->integer('pages')->nullable();

            $table->integer('quantity')->default(0);

            $table->integer('available_quantity')->default(0);

            $table->integer('issued_quantity')->default(0);

            $table->integer('damaged_quantity')->default(0);

            $table->integer('lost_quantity')->default(0);

            $table->decimal('purchase_price', 10, 2)->default(0);

            $table->decimal('selling_price', 10, 2)->default(0);

            $table->text('description')->nullable();

            $table->boolean('status')->default(true);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('library_books');
    }
};
