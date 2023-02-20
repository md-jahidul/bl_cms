<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropMobileImageNameAtRoamingCagegoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_cagegories', function(Blueprint $table) {
            if (Schema::hasColumn('roaming_cagegories', 'banner_name_mobile_en')) {
                $table->dropColumn(['banner_name_mobile_en', 'banner_name_mobile_bn']);
            }

            if (Schema::hasColumn('roaming_cagegories', 'banner_name_web_bn')) {
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
        Schema::table('roaming_cagegories', function(Blueprint $table) {
            if (!Schema::hasColumn('roaming_cagegories', 'banner_name_mobile_en')) {
                $table->string('banner_name_mobile_en')->nullable();
                $table->string('banner_name_mobile_bn')->nullable();
            }

            if (Schema::hasColumn('roaming_cagegories', 'banner_name_bn')) {
                $table->renameColumn('banner_name_bn', 'banner_name_web_bn');
            }
        });
    }
}
