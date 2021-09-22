<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldsInEthicsPageInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ethics_page_info', function (Blueprint $table) {
            $table->longText('page_header_bn')->nullable()->after('page_header');
            $table->string('url_slug_bn')->nullable()->after('url_slug');
            $table->string('alt_text_bn')->nullable()->after('alt_text');
            $table->string('banner_name')->nullable()->after('banner_mobile');
            $table->string('banner_name_bn')->nullable()->after('banner_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ethics_page_info', function (Blueprint $table) {
            $table->dropColumn('page_header_bn');
            $table->dropColumn('url_slug_bn');
            $table->dropColumn('alt_text_bn');
            $table->dropColumn('banner_name');
            $table->dropColumn('banner_name_bn');
        });
    }
}
