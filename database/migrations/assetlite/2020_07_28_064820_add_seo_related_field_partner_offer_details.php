<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSeoRelatedFieldPartnerOfferDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('partner_offer_details', function (Blueprint $table) {
            $table->text('page_header')->nullable()->after('partner_offer_id');
            $table->text('page_header_bn')->nullable()->after('page_header');
            $table->text('schema_markup')->nullable()->after('page_header_bn');
            $table->string('url_slug')->nullable()->after('schema_markup');
            $table->integer('created_by')->nullable()->after('updated_at');
            $table->integer('updated_by')->nullable()->after('created_by');
            $table->string('banner_mobile_view')->nullable()->after('banner_image_url');
            $table->string('banner_alt_text_bn')->nullable()->after('banner_alt_text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('partner_offer_details', function (Blueprint $table) {
            $table->dropColumn('page_header');
            $table->dropColumn('page_header_bn');
            $table->dropColumn('schema_markup');
            $table->dropColumn('url_slug');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('banner_mobile_view');
            $table->dropColumn('banner_alt_text_bn');
        });
    }
}
