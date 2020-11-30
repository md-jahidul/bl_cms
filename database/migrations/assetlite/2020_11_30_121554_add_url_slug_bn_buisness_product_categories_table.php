<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlSlugBnBuisnessProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_product_categories', function(Blueprint $table) {
            if(!Schema::hasColumn('business_product_categories', 'url_slug_bn')) {
                $table->string('url_slug_bn')->after('url_slug')->nullable();
                $table->string('banner_name_web_bn')->after('banner_name')->nullable();
                $table->string('banner_name_mobile')->after('banner_name_web_bn')->nullable();
                $table->string('banner_name_mobile_bn')->after('banner_name_mobile')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_product_categories', function(Blueprint $table) {
            if(Schema::hasColumn('business_product_categories', 'url_slug_bn')) {
                $table->dropColumn('url_slug_bn');
                $table->dropColumn('banner_name_web_bn');
                $table->dropColumn('banner_name_mobile');
                $table->dropColumn('banner_name_mobile_bn');
            }
        });
    }
}
