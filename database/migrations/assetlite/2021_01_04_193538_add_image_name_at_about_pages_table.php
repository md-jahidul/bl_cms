<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameAtAboutPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_pages', function (Blueprint $table) {
            if (!Schema::hasColumn('about_pages', 'left_img_name_en')) {
                $table->string('left_img_name_en')->after('details_bn')->nullable();
                $table->string('left_img_name_bn')->after('left_img_name_en')->nullable();
                $table->string('left_img_alt_text_en')->after('left_img_name_bn')->nullable();
                $table->string('left_img_alt_text_bn')->after('left_img_alt_text_en')->nullable();
                $table->string('right_img_name_en')->after('left_img_alt_text_bn')->nullable();
                $table->string('right_img_name_bn')->after('right_img_name_en')->nullable();
                $table->string('right_img_alt_text_en')->after('right_img_name_bn')->nullable();
                $table->string('right_img_alt_text_bn')->after('right_img_alt_text_en')->nullable();
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
        Schema::table('about_pages', function (Blueprint $table) {
            if (Schema::hasColumn('about_pages', 'left_img_name_en')) {
                $table->dropColumn('left_img_name_en');
                $table->dropColumn('left_img_name_bn');
                $table->dropColumn('left_img_alt_text_en');
                $table->dropColumn('left_img_alt_text_bn');
                $table->dropColumn('right_img_name_en');
                $table->dropColumn('right_img_name_bn');
                $table->dropColumn('right_img_alt_text_en');
                $table->dropColumn('right_img_alt_text_bn');
            }
        });
    }
}
