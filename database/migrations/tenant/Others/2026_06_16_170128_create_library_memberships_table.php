<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('library_memberships', function (Blueprint $table) {
            $table->id();

            $table->string('membership_card_number')->unique()->comment('Unique printed token on physical card');
            $table->string('barcode_token')->nullable()->unique()->comment('Barcode symbology for rapid scanning');
            $table->text('qr_code_payload')->nullable()->comment('Encrypted metadata payload for dynamic mobile tracking');


            $table->unsignedBigInteger('student_id')->unique();
            $table->unsignedBigInteger('session_id');


            $table->date('activation_date');
            $table->date('expiry_date');
            $table->date('last_renewed_at')->nullable();

            $table->integer('max_borrow_limit')->default(3)->comment('Maximum number of books allocated at a single time');
            $table->integer('borrow_duration_days')->default(14)->comment('Standard cycle allocation days');

            $table->decimal('security_deposit', 10, 2)->default(0.00);
            $table->boolean('is_deposit_refundable')->default(true);

            $table->tinyInteger('status')->default(1)->comment('1: Active, 0: Suspended, 2: Expired, 3: Blacklisted');
            $table->string('suspension_reason')->nullable();

            $table->string('created_by_user_id')->nullable();
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->index(['membership_card_number', 'status']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('library_memberships');
    }
};
