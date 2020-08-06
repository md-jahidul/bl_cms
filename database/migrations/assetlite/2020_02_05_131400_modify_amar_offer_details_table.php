<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAmarOfferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amar_offer_details', function (Blueprint $table) {
            $table->text('details_en')->nullable()->change();
            $table->text('details_bn')->nullable()->change();
            $table->string('type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amar_offer_details', function (Blueprint $table) {
            $table->string('details_en')->nullable()->change();
            $table->string('details_bn')->nullable()->change();
            $table->tinyInteger('type')->comment('1=internet,2=voice,3=bundle')->change();
        });
    }
}
