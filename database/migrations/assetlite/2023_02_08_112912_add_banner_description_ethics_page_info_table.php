<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerDescriptionEthicsPageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ethics_page_info', function (Blueprint $table) {
            $table->text('banner_desc_bn')->after('page_name_en')->nullable();
            $table->text('banner_desc_en')->after('page_name_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ethics_page_info', function (Blueprint $table) {
            $table->dropColumn('banner_desc_bn');
            $table->dropColumn('banner_desc_en');
        });
    }
}
