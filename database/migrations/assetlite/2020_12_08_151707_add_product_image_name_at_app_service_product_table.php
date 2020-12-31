<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductImageNameAtAppServiceProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_service_products', function(Blueprint $table) {
            if(!Schema::hasColumn('app_service_products', 'product_img_en')) {
                $table->string('product_img_en')->after('product_img_url')->nullable();
                $table->string('product_img_bn')->after('product_img_en')->nullable();
                $table->string('alt_text_en')->after('product_img_bn')->nullable();
                $table->string('alt_text_bn')->after('alt_text_en')->nullable();
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
        Schema::table('app_service_products', function(Blueprint $table) {
            if(Schema::hasColumn('app_service_products', 'product_img_en')) {
                $table->dropColumn('product_img_en');
                $table->dropColumn('product_img_bn');
                $table->dropColumn('alt_text_en');
                $table->dropColumn('alt_text_bn');
            }
        });
    }
}
