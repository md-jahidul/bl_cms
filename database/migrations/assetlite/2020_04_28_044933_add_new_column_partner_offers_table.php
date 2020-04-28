<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnPartnerOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_offers', function (Blueprint $table) {
            $table->text('map_link')->nullable()->after('btn_text_bn');
            $table->text('location')->nullable()->after('btn_text_bn');
            $table->string('phone')->nullable()->after('btn_text_bn');
            $table->smallInteger('area_id')->default(0)->after('btn_text_bn');
            $table->tinyInteger('platium')->default(0)->after('btn_text_bn');
            $table->tinyInteger('gold')->default(0)->after('btn_text_bn');
            $table->tinyInteger('silver')->default(0)->after('btn_text_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('partner_offers', function (Blueprint $table) {
            $table->dropColumn('map_link');
            $table->dropColumn('location');
            $table->dropColumn('phone');
            $table->dropColumn('area_id');
            $table->dropColumn('platium');
            $table->dropColumn('gold');
            $table->dropColumn('silver');
        });
    }
}
