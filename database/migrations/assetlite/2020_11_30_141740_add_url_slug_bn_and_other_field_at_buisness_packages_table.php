<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlSlugBnAndOtherFieldAtBuisnessPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_packages', function(Blueprint $table) {
            if(!Schema::hasColumn('business_packages', 'url_slug_bn')) {
                $table->string('url_slug_bn')->after('url_slug')->nullable();
                $table->string('card_banner_name_web_en')->after('card_banner_web')->nullable();
                $table->string('card_banner_name_web_bn')->after('card_banner_name_web_en')->nullable();
                $table->string('card_banner_name_mobile_en')->after('card_banner_name_web_bn')->nullable();
                $table->string('card_banner_name_mobile_bn')->after('card_banner_name_mobile_en')->nullable();
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
        Schema::table('business_packages', function(Blueprint $table) {
            if(Schema::hasColumn('business_packages', 'url_slug_bn')) {
                $table->dropColumn('url_slug_bn');
                $table->dropColumn('card_banner_name_web_en');
                $table->dropColumn('card_banner_name_web_bn');
                $table->dropColumn('card_banner_name_mobile_en');
                $table->dropColumn('card_banner_name_mobile_bn');
                $table->dropColumn('banner_name_web_bn');
                $table->dropColumn('banner_name_mobile_en');
                $table->dropColumn('banner_name_mobile_bn');
            }
        });
    }
}
