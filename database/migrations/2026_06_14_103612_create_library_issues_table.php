<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('library_issues', function (Blueprint $table) {
            $table->id();
  $table->unsignedBigInteger('school_id')->nullable();
            $table->unsignedBigInteger('session_id');

            $table->foreignId('book_id');

            $table->enum('member_type', [
                'student',
                'staff'
            ]);

            $table->unsignedBigInteger('member_id');

            $table->date('issue_date');

            $table->date('due_date');

            $table->date('return_date')->nullable();

            $table->integer('issue_days')->default(0);

            $table->decimal('fine_amount', 10, 2)->default(0);

            $table->decimal('gst_amount', 10, 2)->default(0);

            $table->decimal('total_fine_amount', 10, 2)->default(0);

            $table->enum('status', [
                'issued',
                'returned',
                'lost',
                'damaged'
            ])->default('issued');

            $table->text('remarks')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

 
    public function down(): void
    {
        Schema::dropIfExists('library_issues');
    }
};
