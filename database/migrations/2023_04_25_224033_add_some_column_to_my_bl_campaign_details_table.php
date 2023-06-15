<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumnToMyBlCampaignDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_campaign_details', function (Blueprint $table) {
            $table->double('max_recharge_amount', 8, 2)->nullable()->after('recharge_amount');
            $table->string('bonus_product_code')->nullable();
            $table->string('numbers_of_get_bonus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_campaign_details', function (Blueprint $table) {
            $table->dropColumn('max_recharge_amount');
            $table->dropColumn('bonus_product_code');
            $table->dropColumn('numbers_of_get_bonus');
        });
    }
}
