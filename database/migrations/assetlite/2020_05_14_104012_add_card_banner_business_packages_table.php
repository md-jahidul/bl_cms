<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCardBannerBusinessPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('business_packages', function (Blueprint $table) {
            $table->string('card_banner_web')->nullable()->after('name_bn');
            $table->string('card_banner_mobile')->nullable()->after('name_bn');
            $table->string('card_banner_alt_text')->nullable()->after('name_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('business_packages', function (Blueprint $table) {
            $table->dropColumn('card_banner_web');
            $table->dropColumn('card_banner_mobile');
            $table->dropColumn('card_banner_alt_text');
        });
    }
}
