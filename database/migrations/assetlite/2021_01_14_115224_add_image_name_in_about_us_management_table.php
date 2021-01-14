<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameInAboutUsManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('about_us_manangement', function (Blueprint $table) {
            if (!Schema::hasColumn('about_us_manangement', 'profile_img_name')) {
                $table->string('profile_img_name')->after('profile_image')->nullable();
                $table->string('profile_img_name_bn')->after('profile_img_name')->nullable();
                $table->string('profile_img_alt_text')->after('profile_img_name_bn')->nullable();
                $table->string('profile_img_alt_text_bn')->after('profile_img_alt_text')->nullable();
                $table->string('banner_img_name')->after('banner_image')->nullable();
                $table->string('banner_img_name_bn')->after('banner_img_name')->nullable();
                $table->string('banner_img_alt_text')->after('banner_img_name_bn')->nullable();
                $table->string('banner_img_alt_text_bn')->after('banner_img_alt_text')->nullable();
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
        Schema::table('about_us_manangement', function (Blueprint $table) {
            if (Schema::hasColumn('about_us_manangement', 'profile_img_name')) {
                $table->dropColumn('profile_img_name');
                $table->dropColumn('profile_img_name_bn');
                $table->dropColumn('profile_img_alt_text');
                $table->dropColumn('profile_img_alt_text_bn');
                $table->dropColumn('banner_img_name');
                $table->dropColumn('banner_img_name_bn');
                $table->dropColumn('banner_img_alt_text');
                $table->dropColumn('banner_img_alt_text_bn');
            }
        });
    }
}
