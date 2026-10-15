<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_shift_assignments', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Employee
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_id')
                ->constrained('employees')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Shift
            |--------------------------------------------------------------------------
            */

            $table->foreignId('shift_id')
                ->constrained('shifts')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Assignment Period
            |--------------------------------------------------------------------------
            */

            $table->date('effective_from');

            $table->date('effective_to')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Assignment Type
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('assignment_type')
                ->default(1);

            /*
             * 1 = Regular
             * 2 = Temporary
             * 3 = Emergency
             * 4 = Rotation
             */


            /*
            |--------------------------------------------------------------------------
            | Source
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('source_type')
                ->default(1);

            /*
             * 1 = Manual
             * 2 = System
             * 3 = Import
             */


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('status')
                ->default(true);


            /*
            |--------------------------------------------------------------------------
            | Remarks
            |--------------------------------------------------------------------------
            */

            $table->text('remarks')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Audit
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();


            $table->timestamps();
            $table->softDeletes();


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('employee_id');
            $table->index('shift_id');

            $table->index([
                'employee_id',
                'effective_from'
            ]);

            $table->index([
                'employee_id',
                'effective_to'
            ]);

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_shift_assignments');
    }
};