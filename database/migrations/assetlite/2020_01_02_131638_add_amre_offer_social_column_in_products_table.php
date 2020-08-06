<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAmreOfferSocialColumnInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->tinyInteger('is_amar_offer')->after('is_gift_offer')->nullable();
            $table->tinyInteger('is_social_pack')->after('is_amar_offer')->nullable();
            $table->string('name_en')->nullable()->change();
            $table->string('name_bn')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_amar_offer');
            $table->dropColumn('is_social_pack');
        });
    }
}
