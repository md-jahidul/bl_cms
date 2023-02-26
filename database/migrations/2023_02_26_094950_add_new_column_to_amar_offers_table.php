<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnToAmarOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amar_offers', function (Blueprint $table) {
            $table->string('short_description')->nullable();
            $table->string('description_bn')->nullable();
            $table->string('short_description_bn')->nullable();
            $table->string('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amar_offers', function (Blueprint $table) {
            $table->dropColumn('short_description');
            $table->dropColumn('description_bn');
            $table->dropColumn('short_description_bn');
        });
    }
}
