<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up(): void
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();

            $table->string('ticket_no', 20)->unique();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone', 20);

            $table->string('priority', 30)->default('Normal');
            $table->text('company_message');
            $table->text('client_message');
            $table->text('company_reply')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->unsignedBigInteger('replied_by')->nullable();

            // Open | In Progress | Resolved | Closed
            $table->string('status', 30)->default('Open')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
