<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnSsdcodeMessageToSliderImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('slider_images', function (Blueprint $table) {
            //
            $table->string('ussd_code',20)->nullable()->after('display_type');
            $table->string('message_en',250)->nullable()->after('ussd_code');
            $table->string('message_bn',250)->nullable()->after('message_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('slider_images', function (Blueprint $table) {
            //
            $table->dropColumn('ussd_code');
            $table->dropColumn('message_en');
            $table->dropColumn('message_bn');
        });
    }
}
