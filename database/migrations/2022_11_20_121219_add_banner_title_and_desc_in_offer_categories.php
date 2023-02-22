<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBannerTitleAndDescInOfferCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('offer_categories', function (Blueprint $table) {
            $table->string('prepaid_banner_title_en')->nullable()->after('other_attributes');
            $table->string('prepaid_banner_title_bn')->nullable()->after('other_attributes');;
            $table->text('prepaid_banner_desc_en')->nullable()->after('other_attributes');;
            $table->text('prepaid_banner_desc_bn')->nullable()->after('other_attributes');;
            $table->string('postpaid_banner_title_en')->nullable()->after('other_attributes');;
            $table->string('postpaid_banner_title_bn')->nullable()->after('other_attributes');;
            $table->text('postpaid_banner_desc_en')->nullable()->after('other_attributes');;
            $table->text('postpaid_banner_desc_bn')->nullable()->after('other_attributes');;
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
            $table->dropColumn('prepaid_banner_title_en');
            $table->dropColumn('prepaid_banner_title_bn');
            $table->dropColumn('prepaid_banner_desc_en');
            $table->dropColumn('prepaid_banner_desc_bn');
            $table->dropColumn('postpaid_banner_title_en');
            $table->dropColumn('postpaid_banner_title_bn');
            $table->dropColumn('postpaid_banner_desc_en');
            $table->dropColumn('postpaid_banner_desc_bn');
        });
    }
}
