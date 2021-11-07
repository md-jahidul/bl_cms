<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropImageMobileNameFromBusinessPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_packages', function(Blueprint $table) {
            /* new column added */
            if(!Schema::hasColumn('business_packages', 'card_banner_alt_text_bn')) {
                $table->string('card_banner_alt_text_bn')->after('card_banner_alt_text')->nullable();
            }

            /* drop existing unnecessary column */
            if (Schema::hasColumn('business_packages', 'card_banner_name_mobile_en')) {
                $table->dropColumn(['card_banner_name_mobile_en', 'card_banner_name_mobile_bn',
                                        'banner_name_mobile_en', 'banner_name_mobile_bn']);
            }

            /* rename existing column */
            if (Schema::hasColumn('business_packages', 'card_banner_name_web_en')) {
                $table->renameColumn('card_banner_name_web_en', 'card_banner_name_en');
                $table->renameColumn('card_banner_name_web_bn', 'card_banner_name_bn');
                $table->renameColumn('banner_name_web_bn', 'banner_name_bn');
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
            if (Schema::hasColumn('business_packages', 'card_banner_alt_text_bn')) {
                $table->dropColumn('card_banner_alt_text_bn');
            }

            if (!Schema::hasColumn('business_packages', 'card_banner_name_mobile_en')) {
                $table->string('card_banner_name_mobile_en')->nullable();
                $table->string('card_banner_name_mobile_bn')->nullable();
                $table->string('banner_name_mobile_en')->nullable();
                $table->string('banner_name_mobile_bn')->nullable();
            }

            if (Schema::hasColumn('business_packages', 'card_banner_name_en')) {
                $table->renameColumn('card_banner_name_en', 'card_banner_name_web_en');
                $table->renameColumn('card_banner_name_bn', 'card_banner_name_web_bn');
                $table->renameColumn('banner_name_bn', 'banner_name_web_bn');
            }
        });
    }
}
