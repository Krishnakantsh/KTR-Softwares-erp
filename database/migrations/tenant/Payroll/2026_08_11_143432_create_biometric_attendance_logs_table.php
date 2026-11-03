<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biometric_attendance_logs', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | School / Branch
            |--------------------------------------------------------------------------
            */

            $table->foreignId('school_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('branch_id')
                ->nullable()
                ->constrained('branches')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Attendance Device
            |--------------------------------------------------------------------------
            */

            $table->foreignId('attendance_device_id')
                ->constrained('attendance_devices')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Employee
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Biometric Identity
            |--------------------------------------------------------------------------
            |
            | Keep the original biometric identifier even if employee mapping
            | changes later.
            |--------------------------------------------------------------------------
            */

            $table->string('biometric_id', 100);


            /*
            |--------------------------------------------------------------------------
            | Device User / Enrollment ID
            |--------------------------------------------------------------------------
            */

            $table->string('device_user_id', 100)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Punch Information
            |--------------------------------------------------------------------------
            */

            $table->dateTime('punch_at');

            $table->unsignedTinyInteger('punch_type')
                ->nullable();

            /*
             * 1 = IN
             * 2 = OUT
             * 3 = Break IN
             * 4 = Break OUT
             * 5 = Unknown
             */


            /*
            |--------------------------------------------------------------------------
            | Verification
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('verification_type')
                ->nullable();

            /*
             * 1 = Fingerprint
             * 2 = Face
             * 3 = Card
             * 4 = PIN
             * 5 = Password
             * 6 = Other
             */


            /*
            |--------------------------------------------------------------------------
            | Device Information
            |--------------------------------------------------------------------------
            */

            $table->string('device_serial_number', 150)
                ->nullable();

            $table->string('device_punch_id', 150)
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Raw Device Data
            |--------------------------------------------------------------------------
            */

            $table->json('raw_payload')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Source / Sync
            |--------------------------------------------------------------------------
            */

            $table->unsignedTinyInteger('source')
                ->default(1);

            /*
             * 1 = Device
             * 2 = API
             * 3 = Import
             * 4 = Manual Sync
             */


            $table->unsignedTinyInteger('sync_status')
                ->default(1);

            /*
             * 1 = Received
             * 2 = Processed
             * 3 = Failed
             * 4 = Ignored
             */


            /*
            |--------------------------------------------------------------------------
            | Processing
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_processed')
                ->default(false);

            $table->timestamp('processed_at')
                ->nullable();


            /*
            |--------------------------------------------------------------------------
            | Duplicate Detection
            |--------------------------------------------------------------------------
            */

            $table->string('event_hash', 128);


            $table->boolean('is_duplicate')
                ->default(false);


            /*
            |--------------------------------------------------------------------------
            | Error Handling
            |--------------------------------------------------------------------------
            */

            $table->text('processing_error')
                ->nullable();

            $table->unsignedTinyInteger('attempt_count')
                ->default(0);


            /*
            |--------------------------------------------------------------------------
            | Attendance Mapping
            |--------------------------------------------------------------------------
            */

            $table->foreignId('employee_attendance_id')
                ->nullable()
                ->constrained('employee_attendance')
                ->nullOnDelete();


            /*
            |--------------------------------------------------------------------------
            | Server Sync Time
            |--------------------------------------------------------------------------
            */

            $table->timestamp('received_at')
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

            $table->unique('event_hash');

            $table->index('school_id');
            $table->index('branch_id');

            $table->index('attendance_device_id');

            $table->index('employee_id');

            $table->index('biometric_id');

            $table->index('device_user_id');

            $table->index('punch_at');

            $table->index([
                'employee_id',
                'punch_at'
            ]);

            $table->index([
                'biometric_id',
                'punch_at'
            ]);

            $table->index('device_punch_id');

            $table->index('sync_status');

            $table->index('is_processed');

            $table->index('is_duplicate');

            $table->index('employee_attendance_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biometric_attendance_logs');
    }
};