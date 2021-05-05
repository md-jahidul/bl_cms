<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanglaFieldInPrivacyPolicies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('privacy_policies', function (Blueprint $table) {
            $table->longText('privacy_policy_bn')->after('privacy_policy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('privacy_policies', function (Blueprint $table) {
            $table->dropColumn('privacy_policy_bn');
        });
    }
}
