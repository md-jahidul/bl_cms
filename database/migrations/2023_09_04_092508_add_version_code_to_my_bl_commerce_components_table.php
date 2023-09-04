<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersionCodeToMyBlCommerceComponentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('my_bl_commerce_components', function (Blueprint $table) {
            $table->bigInteger('version_code')->default(0)->after('is_eligible');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('my_bl_commerce_components', function (Blueprint $table) {
            $table->dropColumn('version_code');
        });
    }
}
