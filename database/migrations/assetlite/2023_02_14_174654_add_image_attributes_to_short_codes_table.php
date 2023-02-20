<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageAttributesToShortCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('short_codes', function (Blueprint $table) {
            $table->string('image_url')->after('title_en')->nullable();
            $table->string('mobile_view_img')->after('title_en')->nullable();
            $table->string('alt_text_en')->after('title_en')->nullable();
            $table->string('alt_text_bn')->after('title_en')->nullable();
            $table->string('image_name')->after('title_en')->nullable();
            $table->string('image_name_bn')->after('title_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('short_codes', function (Blueprint $table) {
            $table->dropColumn('image_url');
            $table->dropColumn('mobile_view_img');
            $table->dropColumn('alt_text_en');
            $table->dropColumn('alt_text_bn');
            $table->dropColumn('image_name');
            $table->dropColumn('image_name_bn');
        });
    }
}
