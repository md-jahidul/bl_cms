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
            $table->string('card_img_name_en')->after('card_img')->nullable();
            $table->string('card_img_name_bn')->after('card_img_name_en')->nullable();
            $table->string('card_alt_text_en')->after('card_img_name_bn')->nullable();
            $table->string('card_alt_text_bn')->after('card_alt_text_en')->nullable();
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
            $table->dropColumn('card_img_name_en');
            $table->dropColumn('card_img_name_bn');
            $table->dropColumn('card_alt_text_en');
            $table->dropColumn('card_alt_text_bn');
            $table->dropColumn('loyalty_tier_id');
            $table->dropColumn('partner_category_id');
        });
    }
}
