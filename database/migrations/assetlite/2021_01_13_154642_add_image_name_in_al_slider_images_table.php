<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameInAlSliderImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('al_slider_images', function (Blueprint $table) {
            if (!Schema::hasColumn('al_slider_images', 'image_name')) {
                $table->string('image_name')->after('image_url')->nullable();
                $table->string('image_name_bn')->after('image_name')->nullable();
                $table->string('alt_text_bn')->after('alt_text')->nullable();
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
        Schema::table('al_slider_images', function (Blueprint $table) {
            if (Schema::hasColumn('al_slider_images', 'image_name')) {
                $table->dropColumn('image_name');
                $table->dropColumn('image_name_bn');
                $table->dropColumn('alt_text_bn');
            }
        });
    }
}
