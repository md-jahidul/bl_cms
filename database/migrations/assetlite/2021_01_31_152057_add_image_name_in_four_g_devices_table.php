<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameInFourGDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('four_g_devices', function (Blueprint $table) {
            if (!Schema::hasColumn('four_g_devices', 'logo_img_name_en')) {
                $table->string('logo_img_name_en')->after('card_logo')->nullable();
                $table->string('logo_img_name_bn')->after('logo_img_name_en')->nullable();
                $table->string('thumbnail_img_name_en')->after('thumbnail_image')->nullable();
                $table->string('thumbnail_img_name_bn')->after('thumbnail_img_name_en')->nullable();
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
        Schema::table('four_g_devices', function (Blueprint $table) {
            if (Schema::hasColumn('four_g_devices', 'logo_img_name_en')) {
                $table->dropColumn('logo_img_name_en');
                $table->dropColumn('logo_img_name_bn');
                $table->dropColumn('thumbnail_img_name_en');
                $table->dropColumn('thumbnail_img_name_bn');
            }
        });
    }
}
