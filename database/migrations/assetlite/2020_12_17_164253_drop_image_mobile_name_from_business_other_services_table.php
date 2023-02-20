<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropImageMobileNameFromBusinessOtherServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_other_services', function (Blueprint $table) {
            /* add new column */
            if (!Schema::hasColumn('business_other_services', 'details_alt_text_bn')) {
                $table->string('details_alt_text_bn')->nullable()->after('details_alt_text');
            }

            /* drop some existing column */
            if (Schema::hasColumn('business_other_services', 'details_banner_name_mobile_en')) {
                $table->dropColumn(['details_banner_name_mobile_en', 'details_banner_name_mobile_bn',
                                    'banner_name_mobile_en', 'banner_name_mobile_bn']);
            }

            /* rename existing column */
            if (Schema::hasColumn('business_other_services', 'details_banner_name_web_bn')) {
                $table->renameColumn('details_banner_name_web_bn', 'details_banner_name_bn');
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
        Schema::table('business_other_services', function (Blueprint $table) {
            if (Schema::hasColumn('business_other_services', 'details_alt_text_bn')) {
                $table->dropColumn('details_alt_text_bn');
            }

            if (!Schema::hasColumn('business_other_services', 'details_banner_name_mobile_en')) {
                $table->string('details_banner_name_mobile_en')->nullable();
                $table->string('details_banner_name_mobile_bn')->nullable();
                $table->string('banner_name_mobile_en')->nullable();
                $table->string('banner_name_mobile_bn')->nullable();
            }

            if (Schema::hasColumn('business_other_services', 'details_banner_name_bn')) {
                $table->renameColumn('details_banner_name_bn', 'details_banner_name_web_bn');
                $table->renameColumn('banner_name_bn', 'banner_name_web_bn');
            }
        });
    }
}
