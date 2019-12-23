<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOfferCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('offer_categories', function (Blueprint $table) {
           $table->string('banner_image_url')->nullable()->after('type_id');
           $table->string('banner_alt_text')->nullable()->after('banner_image_url');
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
            $table->dropColumn('banner_image_url');
            $table->dropColumn('banner_alt_text');
        });
    }
}
