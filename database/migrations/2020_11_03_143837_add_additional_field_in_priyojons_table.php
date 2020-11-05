<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldInPriyojonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('priyojons', function (Blueprint $table) {
            $table->string('banner_image_url')->nullable();
            $table->string('banner_mobile_view')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('alt_text_bn')->nullable();
            $table->string('banner_name')->nullable();
            $table->string('url')->nullable();
            $table->string('title_bn')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('priyojons', function (Blueprint $table) {
            $table->dropColumn('banner_image_url');
            $table->dropColumn('banner_mobile_view');
            $table->dropColumn('alt_text_en');
            $table->dropColumn('alt_text_bn');
            $table->dropColumn('banner_name');
            $table->dropColumn('url');
        });
    }
}
