<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoItemsFieldOtherDynamicPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_dynamic_page', function (Blueprint $table) {
            $table->string('url_slug_bn')->nullable()->after('url_slug');
            $table->string('banner_name_bn')->nullable()->after('url_slug_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('other_dynamic_page', function (Blueprint $table) {
            $table->dropColumn('url_slug_bn');
            $table->dropColumn('banner_name_bn');
        });
    }
}
