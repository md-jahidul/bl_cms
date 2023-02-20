<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameAtBusinessHomeBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_home_banner', function(Blueprint $table) {
            if(!Schema::hasColumn('business_home_banner', 'image_name_en')) {
                $table->string('image_name_en')->after('image_name')->nullable();
                $table->string('image_name_bn')->after('image_name_en')->nullable();
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
        Schema::table('business_home_banner', function(Blueprint $table) {
            if(Schema::hasColumn('business_home_banner', 'image_name_en')) {
                $table->dropColumn('image_name_en');
                $table->dropColumn('image_name_bn');
                $table->dropColumn('alt_text_bn');
            }
        });
    }
}
