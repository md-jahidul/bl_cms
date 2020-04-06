<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherAttributesInOfferCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_categories', function (Blueprint $table) {
            $table->json('other_attributes')->nullable()->after('page_header');
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
            $table->dropColumn('other_attributes');
        });
    }
}
