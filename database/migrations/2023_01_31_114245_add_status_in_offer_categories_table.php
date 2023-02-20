<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusInOfferCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_categories', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->after('other_attributes');
            $table->integer('display_order')->default(1)->after('other_attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_categories', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('display_order');
        });
    }
}
