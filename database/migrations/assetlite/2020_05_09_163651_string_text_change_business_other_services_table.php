<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StringTextChangeBusinessOtherServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_other_services', function (Blueprint $table) {
            $table->text('home_short_details_bn')->change();
            $table->text('home_short_details_en')->change();
            $table->text('short_details')->change();
            $table->text('short_details_bn')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('business_other_services', function (Blueprint $table) {
            $table->string('home_short_details_bn')->change();
            $table->string('home_short_details_en')->change();
            $table->string('short_details')->change();
            $table->string('short_details_bn')->change();
        });
    }
}
