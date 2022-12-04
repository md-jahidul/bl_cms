<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyInPartnerOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_offers', function (Blueprint $table) {
            $table->string('card_img')->after('product_code')->nullable();
            $table->string('card_img_en')->after('card_img')->nullable();
            $table->string('card_img_bn')->after('card_img_en')->nullable();
            $table->string('alt_text_en')->after('card_img_bn')->nullable();
            $table->string('alt_text_bn')->after('alt_text_en')->nullable();
            $table->unsignedBigInteger('loyalty_tier_id')->after('partner_id')->nullable();
            $table->unsignedBigInteger('partner_category_id')->after('partner_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_offers', function (Blueprint $table) {
            $table->dropColumn('card_img');
            $table->dropColumn('loyalty_tier_id');
            $table->dropColumn('partner_category_id');
        });
    }
}
