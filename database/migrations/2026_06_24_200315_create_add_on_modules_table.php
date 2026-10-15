<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('add_on_modules', function (Blueprint $table) {
            $table->id();

            $table->string('name');

            $table->string('code')
                ->unique();

            $table->string('slug')
                ->unique();

            $table->text('description')
                ->nullable();

            $table->decimal(
                'setup_fee',
                12,
                2
            )->default(0);

            $table->decimal(
                'monthly_price',
                12,
                2
            )->default(0);

            $table->decimal(
                'quarterly_price',
                12,
                2
            )->default(0);

            $table->decimal(
                'half_yearly_price',
                12,
                2
            )->default(0);

            $table->foreignId('plan_feature_id')
                ->nullable()
                ->constrained('plan_features')
                ->nullOnDelete();


            $table->decimal(
                'yearly_price',
                12,
                2
            )->default(0);

            $table->boolean('is_recurring')
                ->default(true);

            $table->boolean('status')
                ->default(true);

            $table->integer('sort_order')
                ->default(0);

            $table->json('metadata')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index('code');
            $table->index('slug');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_on_modules');
    }
};
