<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardImageInRoamingOtherOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_other_offer', function (Blueprint $table) {
            $table->string('card_image')->nullable()->after('banner_mobile');
            $table->string('banner_title_en')->nullable()->after('banner_mobile');
            $table->string('banner_title_bn')->nullable()->after('banner_title_en');
            $table->text('banner_desc_en')->nullable()->after('banner_title_bn');
            $table->text('banner_desc_bn')->nullable()->after('banner_desc_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roaming_other_offer', function (Blueprint $table) {
            $table->dropColumn('card_image');
            $table->dropColumn('banner_title_en');
            $table->dropColumn('banner_title_bn');
            $table->dropColumn('banner_desc_en');
            $table->dropColumn('banner_desc_bn');
        });
    }
}
