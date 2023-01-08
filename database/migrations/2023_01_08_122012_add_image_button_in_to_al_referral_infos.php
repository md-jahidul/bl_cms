<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageButtonInToAlReferralInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('al_referral_infos', function (Blueprint $table) {
            //
            $table->string('referral_image')->nullable()->after('details_bn');
            $table->string('btn_title_en',50)->nullable()->after('referral_image');
            $table->string('btn_title_bn',50)->nullable()->after('btn_title_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('al_referral_infos', function (Blueprint $table) {
            //
            $table->dropColumn('referral_image');
            $table->dropColumn('btn_title_en');
            $table->dropColumn('btn_title_bn');
        });
    }
}
