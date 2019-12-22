<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFulltextIndexPartnerOfferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_offer_details', function (Blueprint $table) {
            DB::statement('ALTER TABLE partner_offer_details ADD FULLTEXT search(details_bn, details_en, offer_details_bn, offer_details_en)');
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
            //
        });
    }
}
