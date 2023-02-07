<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardImageIntoBusinessOtherServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('business_other_services', function (Blueprint $table) {
            $table->string('details_card_web')->nullable()->after('details_alt_text_bn');
            $table->string('details_card_mob')->nullable()->after('details_card_web');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('business_other_services', function (Blueprint $table) {
            $table->dropColumn('details_card_web');
            $table->dropColumn('details_card_mob');
        });
    }
}
