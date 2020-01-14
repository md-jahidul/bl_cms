<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerColumnPartnerOfferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('partner_offer_details', function (Blueprint $table) {
            $table->string('banner_image_url')->nullable()->after('avail_bn');
            $table->string('banner_alt_text')->nullable()->after('banner_image_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_offer_details', function (Blueprint $table) {
            $table->dropColumn('banner_image_url');
            $table->dropColumn('banner_alt_text');
        });
    }
}
