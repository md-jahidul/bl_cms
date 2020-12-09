<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCtaNameToNotificationDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('notification_drafts','cta_name')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->string('cta_name')->nullable()->after('body');
             });
        }
        if (!Schema::hasColumn('notification_drafts','cta_action')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->string('cta_action')->nullable()->after('cta_name');
             });
        }
        if (!Schema::hasColumn('notification_drafts','notification_type')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->string('notification_type')->nullable()->after('cta_action');
             });
        }
        if (!Schema::hasColumn('notification_drafts','device_type')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->string('device_type')->nullable()->after('notification_type');
             });
        }

        if (!Schema::hasColumn('notification_drafts','customer_type')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->string('customer_type')->nullable()->after('device_type');
             });
        }
        if (!Schema::hasColumn('notification_drafts','navigate_action')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->string('navigate_action')->nullable()->after('customer_type');
             });
        }
        if (!Schema::hasColumn('notification_drafts','external_url')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->string('external_url')->nullable()->after('navigate_action');
             });
        }
        if (!Schema::hasColumn('notification_drafts','image')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->string('image')->nullable()->after('external_url');
             });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       if (!Schema::hasColumn('notification_drafts','cta_name')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->dropColumn('cta_name');
             });
        }
        if (!Schema::hasColumn('notification_drafts','cta_action')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->dropColumn('cta_action');
             });
        }
        if (!Schema::hasColumn('notification_drafts','notification_type')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->dropColumn('notification_type');
             });
        }
        if (!Schema::hasColumn('notification_drafts','device_type')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->dropColumn('device_type');
             });
        }
        if (!Schema::hasColumn('notification_drafts','customer_type')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->dropColumn('customer_type');
             });
        }
        if (!Schema::hasColumn('notification_drafts','navigate_action')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->dropColumn('navigate_action');
             });
        }
        if (!Schema::hasColumn('notification_drafts','external_url')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->dropColumn('external_url');
             });
        }
        if (!Schema::hasColumn('notification_drafts','image')) {
            Schema::table('notification_drafts', function (Blueprint $table) {
                $table->dropColumn('image');
             });
        }

    }
}
