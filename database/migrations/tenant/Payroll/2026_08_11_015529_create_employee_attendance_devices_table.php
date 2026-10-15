<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_attendance_devices', function (Blueprint $table) {

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
            | Device
            |--------------------------------------------------------------------------
            */

            $table->foreignId('device_id')
                ->constrained('attendance_devices')
                ->restrictOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Device Employee Identity
            |--------------------------------------------------------------------------
            */

            $table->string('device_user_id', 100)
                ->nullable();

            $table->string('biometric_id', 100)
                ->nullable();

            $table->string('rfid_card_number', 100)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Enrollment
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('enrollment_type')
                ->default(1);

            /*
             * 1 = Fingerprint
             * 2 = Face
             * 3 = RFID
             * 4 = Palm
             * 5 = Iris
             * 6 = Multiple
             */


            $table->dateTime('enrolled_at')
                ->nullable();

            $table->dateTime('last_synced_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Sync Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('sync_status')
                ->default(1);

            /*
             * 1 = Pending
             * 2 = Synced
             * 3 = Failed
             * 4 = Disabled
             */


            $table->text('last_sync_error')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_primary')
                ->default(false);

            $table->boolean('status')
                ->default(true);


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
            $table->index('device_id');

            $table->index('device_user_id');
            $table->index('biometric_id');
            $table->index('rfid_card_number');

            $table->index('sync_status');
            $table->index('is_primary');
            $table->index('status');


            /*
            |--------------------------------------------------------------------------
            | Device Mapping
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'device_id',
                'device_user_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_attendance_devices');
    }
};