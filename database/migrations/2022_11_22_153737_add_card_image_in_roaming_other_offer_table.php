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
        });
    }
}
