<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeparateFieldForPostpaidOfferCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_categories', function (Blueprint $table) {
            $table->string('postpaid_banner_image_url')->nullable()->after('banner_image_url');
            $table->string('postpaid_banner_image_mobile')->nullable()->after('banner_image_mobile');

            $table->string('postpaid_alt_text')->nullable()->after('banner_alt_text');
            $table->string('postpaid_alt_text_bn')->nullable()->after('banner_alt_text_bn');
            $table->string('postpaid_banner_name')->nullable()->after('banner_name');
            $table->string('postpaid_banner_name_bn')->nullable()->after('postpaid_banner_name');

            $table->longText('postpaid_schema_markup')->nullable()->after('schema_markup');
            $table->longText('postpaid_page_header')->nullable()->after('page_header');
            $table->longText('postpaid_page_header_bn')->nullable()->after('page_header_bn');
            $table->string('postpaid_url_slug')->nullable()->after('url_slug');
            $table->string('postpaid_url_slug_bn')->nullable()->after('url_slug_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_categories', function (Blueprint $table) {
            $table->dropColumn('postpaid_banner_image_url');
            $table->dropColumn('postpaid_banner_image_mobile');
            $table->dropColumn('postpaid_alt_text');
            $table->dropColumn('postpaid_alt_text_bn');
            $table->dropColumn('postpaid_banner_name');
            $table->dropColumn('postpaid_banner_name_bn');
            $table->dropColumn('postpaid_schema_markup');
            $table->dropColumn('postpaid_page_header');
            $table->dropColumn('postpaid_page_header_bn');
            $table->dropColumn('postpaid_url_slug');
            $table->dropColumn('postpaid_url_slug_bn');
        });
    }
}
