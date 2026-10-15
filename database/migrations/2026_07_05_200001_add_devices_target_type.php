<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL enum columns need raw SQL to add a new allowed value
        DB::statement("ALTER TABLE notifications MODIFY target_type ENUM('user','users','devices','all','topic') NOT NULL");
        DB::statement("ALTER TABLE scheduled_notifications MODIFY target_type ENUM('user','users','devices','all','topic') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE notifications MODIFY target_type ENUM('user','users','all','topic') NOT NULL");
        DB::statement("ALTER TABLE scheduled_notifications MODIFY target_type ENUM('user','users','all','topic') NOT NULL");
    }
};
