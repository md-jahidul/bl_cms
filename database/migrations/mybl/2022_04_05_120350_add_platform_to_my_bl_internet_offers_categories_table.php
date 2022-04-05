<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlatformToMyBlInternetOffersCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_internet_offers_categories', function (Blueprint $table) {
            $table->string('platform')->after('slug')->default('mybl');
            $table->string('name_bn')->after('name')->nullable();

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
            //
        });
    }
}
