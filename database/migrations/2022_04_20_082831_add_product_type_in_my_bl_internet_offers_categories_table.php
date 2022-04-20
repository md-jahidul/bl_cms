<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductTypeInMyBlInternetOffersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_internet_offers_categories', function (Blueprint $table) {
            $table->string('product_type')->default('internet_pack')->after('platform');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_internet_offers_categories', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });
    }
}
