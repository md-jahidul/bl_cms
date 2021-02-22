<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDisplayTitleAndPointsToProductCoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->string('display_title_en')->nullable()->after('display_sd_vat_tax');
            $table->string('display_title_bn')->nullable()->after('display_title_en');
            $table->string('points')->nullable()->after('display_title_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_cores', function (Blueprint $table) {
            $table->dropColumn('display_title_en');
            $table->dropColumn('display_title_bn');
            $table->dropColumn('points');
        });
    }
}
