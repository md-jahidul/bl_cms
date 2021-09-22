<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBanglaUrlInHederMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('url')->nullable()->change();
            $table->string('code')->nullable()->change();
            $table->string('url_bn')->nullable()->after('url');
            $table->tinyInteger('is_dynamic_page')->default(0)->after('url_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('url_bn');
            $table->dropColumn('is_dynamic_page');
        });
    }
}
