<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoFieldsInBeAPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('be_a_partners', function (Blueprint $table) {
            $table->string('banner_mobile_view')->nullable()->after('banner_image');
            $table->longText('page_header')->nullable();
            $table->longText('page_header_bn')->nullable();
            $table->string('url_slug_en')->nullable();
            $table->string('url_slug_bn')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('alt_text_bn')->nullable();
            $table->string('banner_name')->nullable();
            $table->string('banner_name_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('be_a_partners', function (Blueprint $table) {
            $table->dropColumn('banner_mobile_view');
            $table->dropColumn('page_header');
            $table->dropColumn('page_header_bn');
            $table->dropColumn('url_slug_en');
            $table->dropColumn('url_slug_bn');
            $table->dropColumn('alt_text_en');
            $table->dropColumn('alt_text_bn');
            $table->dropColumn('banner_name');
            $table->dropColumn('banner_name_bn');
        });
    }
}
