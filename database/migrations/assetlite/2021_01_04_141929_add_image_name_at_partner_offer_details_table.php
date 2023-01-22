<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameAtPartnerOfferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_offer_details', function (Blueprint $table) {
            if (!Schema::hasColumn('partner_offer_details', 'banner_name')) {
                $table->string('banner_name')->after('banner_alt_text_bn')->nullable();
                $table->string('banner_name_bn')->after('banner_name')->nullable();
                $table->string('url_slug_bn')->after('banner_name_bn')->nullable();
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
        Schema::table('partner_offer_details', function (Blueprint $table) {
            if (Schema::hasColumn('partner_offer_details', 'banner_name')) {
                $table->dropColumn('banner_name');
                $table->dropColumn('banner_name_bn');
                $table->dropColumn('url_slug_bn');
            }
        });
    }
}
