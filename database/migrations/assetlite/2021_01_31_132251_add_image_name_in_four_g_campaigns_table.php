<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameInFourGCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('four_g_campaigns', function (Blueprint $table) {
            if (!Schema::hasColumn('four_g_campaigns', 'image_name_en')) {
                $table->string('image_name_en')->after('image_url')->nullable();
                $table->string('image_name_bn')->after('image_name_en')->nullable();
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
        Schema::table('four_g_campaigns', function (Blueprint $table) {
            if (Schema::hasColumn('four_g_campaigns', 'image_name_en')) {
                $table->dropColumn('image_name_en');
                $table->dropColumn('image_name_bn');
            }
        });
    }
}
