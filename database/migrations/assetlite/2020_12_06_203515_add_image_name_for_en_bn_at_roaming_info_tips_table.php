<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageNameForEnBnAtRoamingInfoTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roaming_info_tips', function(Blueprint $table) {
            if(!Schema::hasColumn('roaming_info_tips', 'banner_name_bn')) {
                $table->string('banner_name_bn')->after('banner_name')->nullable();
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
        Schema::table('roaming_info_tips', function(Blueprint $table) {
            if(Schema::hasColumn('roaming_info_tips', 'banner_name_bn')) {
                $table->dropColumn('banner_name_bn');
            }
        });
    }
}
