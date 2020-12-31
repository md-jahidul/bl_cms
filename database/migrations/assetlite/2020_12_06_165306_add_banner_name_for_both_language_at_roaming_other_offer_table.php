<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerNameForBothLanguageAtRoamingOtherOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_other_offer', function(Blueprint $table) {
            if(!Schema::hasColumn('roaming_other_offer', 'banner_name_bn')) {
                $table->string('banner_name_bn')->after('banner_name')->nullable();
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
        Schema::table('roaming_other_offer', function(Blueprint $table) {
            if(Schema::hasColumn('roaming_other_offer', 'banner_name_bn')) {
                $table->dropColumn('banner_name_bn');
            }
        });
    }
}
