<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropMobileImageNameAtBusinessProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_product_categories', function(Blueprint $table) {
            if (Schema::hasColumn('business_product_categories', 'banner_name_mobile')) {
                $table->dropColumn(['banner_name_mobile', 'banner_name_mobile_bn']);
            }

            if (Schema::hasColumn('business_product_categories', 'banner_name_web_bn')) {
                $table->renameColumn('banner_name_web_bn', 'banner_name_bn');
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
            if (!Schema::hasColumn('business_product_categories', 'banner_name_mobile')) {
                $table->string('banner_name_mobile')->nullable();
                $table->string('banner_name_mobile_bn')->nullable();
            }

            if (Schema::hasColumn('business_product_categories', 'banner_name_bn')) {
                $table->renameColumn('banner_name_bn', 'banner_name_web_bn');
            }
        });
    }
}
