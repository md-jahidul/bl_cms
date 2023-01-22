<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropImageMobileNameFromEcareerPortalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ecareer_portals', function (Blueprint $table) {
            /* drop some existing column */
            if (Schema::hasColumn('ecareer_portals', 'banner_name_mobile_en')) {
                $table->dropColumn(['banner_name_mobile_en', 'banner_name_mobile_bn']);
            }

            /* rename existing column */
            if (Schema::hasColumn('ecareer_portals', 'banner_name_web_bn')) {
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
        Schema::table('ecareer_portals', function (Blueprint $table) {
            if (!Schema::hasColumn('ecareer_portals', 'banner_name_mobile_en')) {
                $table->string('banner_name_mobile_en')->nullable();
                $table->string('banner_name_mobile_bn')->nullable();
            }

            if (Schema::hasColumn('ecareer_portals', 'banner_name_bn')) {
                $table->renameColumn('banner_name_bn', 'banner_name_web_bn');
            }
        });
    }
}
