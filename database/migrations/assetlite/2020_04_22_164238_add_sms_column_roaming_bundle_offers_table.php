<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSmsColumnRoamingBundleOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('roaming_bundle_offers', function (Blueprint $table) {
            $table->string('minute_volume')->nullable()->after('validity_unit');
            $table->string('sms_volume')->nullable()->after('validity_unit');
             $table->dropColumn('price');
             $table->dropColumn('tax');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('roaming_bundle_offers', function (Blueprint $table) {
           
            $table->dropColumn('minute_volume');
            $table->dropColumn('sms_volume');
        });
    }
}
