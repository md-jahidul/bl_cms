<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_details', function (Blueprint $table) {
           $table->string('banner_image_url')->nullable()->after('other_attributes');
           $table->string('banner_alt_text')->nullable()->after('banner_image_url');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_details', function (Blueprint $table) {
            $table->dropColumn('banner_image_url');
            $table->dropColumn('banner_alt_text');
        });
    }
}
