<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersionCodeToMyblManageItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mybl_manage_items', function (Blueprint $table) {
            $table->bigInteger('android_version_code_min')->default(0)->after('deeplink');
            $table->bigInteger('android_version_code_max')->default(999999999)->after('android_version_code_min');
            $table->bigInteger('ios_version_code_min')->default(0)->after('android_version_code_max');
            $table->bigInteger('ios_version_code_max')->default(999999999)->after('ios_version_code_min');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mybl_manage_items', function (Blueprint $table) {
            $table->dropColumn('android_version_code_min');
            $table->dropColumn('android_version_code_max');
            $table->dropColumn('ios_version_code_min');
            $table->dropColumn('ios_version_code_max');
        });
    }
}
