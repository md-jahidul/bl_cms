<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldFooterMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('footer_menus', function (Blueprint $table) {
            $table->tinyInteger('is_dynamic_page')->after('display_order')->default(0);
            $table->string('dynamic_page_slug')->after('is_dynamic_page')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('footer_menus', function (Blueprint $table) {
            $table->dropColumn('is_dynamic_page');
            $table->dropColumn('dynamic_page_slug');
        });
    }
}
