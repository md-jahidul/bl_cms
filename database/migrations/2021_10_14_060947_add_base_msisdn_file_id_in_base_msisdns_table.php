<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBaseMsisdnFileIdInBaseMsisdnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('base_msisdns', function (Blueprint $table) {
            $table->unsignedBigInteger('base_msisdn_file_id')
                ->after('group_id');
//            $table->foreign('base_msisdn_file_id')
//                ->references('id')
//                ->on('base_msisdns')
//                ->onUpdate('cascade')
//                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('base_msisdns', function (Blueprint $table) {
            $table->dropColumn('base_msisdn_file_id')->index();
        });
    }
}
