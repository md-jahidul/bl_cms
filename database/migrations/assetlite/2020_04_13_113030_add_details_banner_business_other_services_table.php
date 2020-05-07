<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDetailsBannerBusinessOtherServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_other_services', function (Blueprint $table) {
            $table->string('details_alt_text')->nullable()->after('banner_image_mobile');
            $table->string('details_banner_name')->nullable()->after('banner_image_mobile');
            $table->string('details_banner_mobile')->nullable()->after('banner_image_mobile');
            $table->string('details_banner_web')->nullable()->after('banner_image_mobile');
            
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
            $table->dropColumn('details_alt_text');
            $table->dropColumn('details_banner_name');
            $table->dropColumn('details_banner_mobile');
            $table->dropColumn('details_banner_web');
        });
    }
}
