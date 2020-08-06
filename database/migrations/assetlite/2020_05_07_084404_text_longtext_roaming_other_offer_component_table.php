<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TextLongtextRoamingOtherOfferComponentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::table('roaming_other_offer_component', function (Blueprint $table) {
            $table->longText('body_text_en')->change();
            $table->longText('body_text_bn')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roaming_other_offer_component', function (Blueprint $table) {
            $table->text('body_text_en')->change();
            $table->text('body_text_bn')->change();
        });
    }
}
