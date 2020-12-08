<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameAtAppServiceProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_product_details', function(Blueprint $table) {
            if(!Schema::hasColumn('app_service_product_details', 'banner_name_web_bn')) {
                $table->string('banner_name_web_bn')->after('banner_name')->nullable();
                $table->string('banner_name_mobile_en')->after('banner_name_web_bn')->nullable();
                $table->string('banner_name_mobile_bn')->after('banner_name_mobile_en')->nullable();
                $table->string('alt_text_bn')->after('alt_text')->nullable();
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
        Schema::table('app_service_product_details', function(Blueprint $table) {
            if(Schema::hasColumn('app_service_product_details', 'banner_name_web_bn')) {
                $table->dropColumn('banner_name_web_bn');
                $table->dropColumn('banner_name_mobile_en');
                $table->dropColumn('banner_name_mobile_bn');
                $table->dropColumn('alt_text_bn');
            }
        });
    }
}
