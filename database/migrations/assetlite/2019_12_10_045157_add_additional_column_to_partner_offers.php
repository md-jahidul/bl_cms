<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalColumnToPartnerOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_offers', function (Blueprint $table) {
            $table->string('offer_scale', 50)->nullable()->after('validity_bn');
            $table->integer('offer_value')->nullable()->after('validity_bn');
            $table->string('offer_unit')->nullable()->after('validity_bn');
            $table->dropColumn('offer_en');
            $table->dropColumn('offer_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partner_offers');
    }
}
