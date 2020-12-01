<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlSlugBnAndOtherFieldsAtBusinessOtherServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_other_services', function(Blueprint $table) {
            if(!Schema::hasColumn('business_other_services', 'url_slug_bn')) {
                $table->string('url_slug_bn')->after('url_slug')->nullable();
                $table->string('details_banner_name_web_bn')->after('details_banner_name')->nullable();
                $table->string('details_banner_name_mobile_en')->after('details_banner_name_web_bn')->nullable();
                $table->string('details_banner_name_mobile_bn')->after('details_banner_name_mobile_en')->nullable();
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
        Schema::table('business_other_services', function(Blueprint $table) {
            if(Schema::hasColumn('business_other_services', 'url_slug_bn')) {
                $table->dropColumn('url_slug_bn');
                $table->dropColumn('details_banner_name_web_bn');
                $table->dropColumn('details_banner_name_mobile_en');
                $table->dropColumn('details_banner_name_mobile_bn');
                $table->dropColumn('banner_name_web_bn');
                $table->dropColumn('banner_name_mobile_en');
                $table->dropColumn('banner_name_mobile_bn');
            }
        });
    }
}
