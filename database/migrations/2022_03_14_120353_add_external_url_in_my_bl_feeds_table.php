<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExternalUrlInMyBlFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_feeds', function (Blueprint $table) {
            $table->string('details_btn_en')->nullable()->after('view_count');
            $table->string('details_btn_bn')->nullable()->after('details_btn_en');
            $table->boolean('ext_link_redirect')->default(false)->after('details_btn_bn');
            $table->string('ext_link_url')->nullable()->after('ext_link_redirect');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_feeds', function (Blueprint $table) {
            $table->dropColumn('details_btn_en');
            $table->dropColumn('details_btn_bn');
            $table->dropColumn('ext_link_redirect');
            $table->dropColumn('ext_link_url');
        });
    }
}
