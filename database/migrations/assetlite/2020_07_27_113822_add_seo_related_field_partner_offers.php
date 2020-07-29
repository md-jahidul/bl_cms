<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoRelatedFieldPartnerOffers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_offers', function (Blueprint $table) {
            $table->text('page_header')->nullable()->after('other_attributes');
            $table->text('page_header_bn')->nullable()->after('page_header');
            $table->text('schema_markup')->nullable()->after('page_header_bn');
            $table->string('url_slug')->nullable()->after('schema_markup');
            $table->integer('created_by')->nullable()->after('url_slug');
            $table->integer('updated_by')->nullable()->after('created_by');
            $table->string('alt_text_en')->nullable()->after('campaign_img');
            $table->string('alt_text_bn')->nullable()->after('alt_text_en');
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
            $table->dropColumn('page_header');
            $table->dropColumn('page_header_bn');
            $table->dropColumn('schema_markup');
            $table->dropColumn('url_slug');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('alt_text_en');
            $table->dropColumn('alt_text_bn');
        });
    }
}
