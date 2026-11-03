<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance_devices', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Organization
            |--------------------------------------------------------------------------
            */

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Device Identity
            |--------------------------------------------------------------------------
            */

            $table->string('device_code', 100);

            $table->string('device_name', 150);

            $table->string('device_type', 50);

            /*
             * Examples:
             *
             * biometric
             * fingerprint
             * face
             * rfid
             * fingerprint_face
             * fingerprint_rfid
             * multi_biometric
             */

            $table->string('serial_number', 150)
                ->nullable();

            $table->string('vendor', 150)
                ->nullable();

            $table->string('model', 150)
                ->nullable();

            $table->string('firmware_version', 100)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Device Location
            |--------------------------------------------------------------------------
            */

            $table->string('location_name', 200)
                ->nullable();

            $table->string('location_description', 255)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Network Configuration
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('connection_type')
                ->default(1);

            /*
             * 1 = LAN
             * 2 = WiFi
             * 3 = Internet
             * 4 = USB
             * 5 = Cloud
             */

            $table->string('ip_address', 45)
                ->nullable();

            $table->unsignedInteger('port')
                ->nullable();

            $table->string('username', 150)
                ->nullable();

            $table->text('password')
                ->nullable();

            $table->string('api_url', 500)
                ->nullable();

            $table->text('api_token')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Device Timezone
            |--------------------------------------------------------------------------
            */

            $table->string('timezone', 100)
                ->default('Asia/Kolkata');


            /*
            |--------------------------------------------------------------------------
            | Device Capabilities
            |--------------------------------------------------------------------------
            */

            $table->boolean('supports_fingerprint')
                ->default(false);

            $table->boolean('supports_face')
                ->default(false);

            $table->boolean('supports_rfid')
                ->default(false);

            $table->boolean('supports_palm')
                ->default(false);

            $table->boolean('supports_iris')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Attendance Direction
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('attendance_direction')
                ->default(3);

            /*
             * 1 = Check In
             * 2 = Check Out
             * 3 = Both
             */


            /*
            |--------------------------------------------------------------------------
            | Sync Configuration
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('sync_mode')
                ->default(1);

            /*
             * 1 = Pull
             * 2 = Push
             * 3 = Both
             * 4 = Manual
             */

            $table->unsignedInteger('sync_interval_seconds')
                ->default(60);

            $table->dateTime('last_sync_at')
                ->nullable();

            $table->dateTime('last_successful_sync_at')
                ->nullable();

            $table->text('last_sync_error')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Device Status
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('connection_status')
                ->default(1);

            /*
             * 1 = Unknown
             * 2 = Online
             * 3 = Offline
             * 4 = Error
             */

            $table->dateTime('last_seen_at')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->boolean('is_online')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Installation
            |--------------------------------------------------------------------------
            */

            $table->date('installation_date')
                ->nullable();

            $table->date('warranty_expiry_date')
                ->nullable();

            $table->string('support_contact', 100)
                ->nullable();

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

            $table->unique([
                'school_id',
                'device_code'
            ]);

            $table->unique([
                'school_id',
                'serial_number'
            ]);

            $table->index('school_id');
            $table->index('branch_id');
            $table->index('device_type');
            $table->index('connection_type');
            $table->index('connection_status');
            $table->index('is_active');
            $table->index('is_online');
            $table->index('last_seen_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance_devices');
    }
};