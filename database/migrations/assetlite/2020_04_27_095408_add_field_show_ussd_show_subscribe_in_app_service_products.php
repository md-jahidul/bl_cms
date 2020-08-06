<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldShowUssdShowSubscribeInAppServiceProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->tinyInteger('show_subscribe')->default(0)->after('show_in_vas');
            $table->tinyInteger('show_ussd')->default(0)->after('show_subscribe');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_service_products', function (Blueprint $table) {
            $table->dropColumn('show_subscribe');
            $table->dropColumn('show_ussd');
        });
    }
}
