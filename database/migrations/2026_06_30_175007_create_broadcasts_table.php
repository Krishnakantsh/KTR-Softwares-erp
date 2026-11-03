<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('broadcasts', function (Blueprint $table) {

            $table->id();

            $table->uuid('uuid')->unique();

            // basic
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();

            // media
            $table->string('image')->nullable();
            $table->string('icon')->nullable();

            // broadcast type
            $table->enum('type', [
                'announcement',
                'broadcast',
                'feature',
                'module',
                'bug_fix',
                'maintenance',
                'security',
                'app_update',
                'subscription',
                'payment',
                'holiday',
                'news',
                'offer',
                'other'
            ])->default('announcement');

            // priority
            $table->enum('priority', [
                'low',
                'normal',
                'high',
                'critical'
            ])->default('normal');

            // audience
            $table->enum('audience_type', [
                'all',
                'selected'
            ])->default('all');

            $table->json('tenant_json')->nullable();

            // module
            $table->string('module_name')->nullable();
            $table->string('module_url')->nullable();

            // button
            $table->string('button_text')->nullable();
            $table->string('button_url')->nullable();

            // platform
            $table->json('platform')->nullable();
            /*
                [
                    "web",
                    "android",
                    "ios"
                ]
            */

            // display
            $table->enum('display_type', [
                'popup',
                'banner',
                'notification',
                'toast'
            ])->default('popup');

            $table->enum('popup_position', [
                'center',
                'top',
                'bottom',
                'top_left',
                'top_right',
                'bottom_left',
                'bottom_right'
            ])->default('center');

            $table->enum('action_type', [
                'none',
                'module',
                'url',
                'download',
                'contact_support',
                'renew_subscription'
            ])->default('none');

            // appearance
            $table->string('banner_color')->nullable();

            // version control
            $table->string('current_version')->nullable();
            $table->string('min_version')->nullable();
            $table->string('max_version')->nullable();

            // behaviour
            $table->boolean('show_popup')->default(true);
            $table->boolean('show_notification')->default(true);
            $table->boolean('is_dismissible')->default(true);
            $table->boolean('requires_acknowledgement')->default(false);

            // repeat
            $table->enum('repeat_type', [
                'once',
                'daily',
                'every_login',
                'until_dismissed'
            ])->default('once');

            $table->integer('display_order')->default(1);

            // schedule
            $table->date('start_date');
            $table->date('end_date');

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            // attachment
            $table->string('attachment')->nullable();

            // status
            $table->enum('status', [
                'draft',
                'active',
                'inactive',
                'expired'
            ])->default('draft');

            // audit
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // indexes
            $table->index('type');
            $table->index('priority');
            $table->index('status');
            $table->index('start_date');
            $table->index('end_date');
            $table->index('audience_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('broadcasts');
    }
};
