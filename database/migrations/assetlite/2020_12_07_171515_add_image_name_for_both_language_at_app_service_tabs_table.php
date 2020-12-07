<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameForBothLanguageAtAppServiceTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_tabs', function(Blueprint $table) {
            if(!Schema::hasColumn('app_service_tabs', 'banner_name_web_bn')) {
                $table->string('banner_name_web_bn')->after('banner_name')->nullable();
                $table->string('banner_name_mobile_en')->after('banner_name_web_bn')->nullable();
                $table->string('banner_name_mobile_bn')->after('banner_name_mobile_en')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_service_tabs', function(Blueprint $table) {
            if(Schema::hasColumn('app_service_tabs', 'banner_name_web_bn')) {
                $table->dropColumn('banner_name_web_bn');
                $table->dropColumn('banner_name_mobile_en');
                $table->dropColumn('banner_name_mobile_bn');
            }
        });
    }
}
