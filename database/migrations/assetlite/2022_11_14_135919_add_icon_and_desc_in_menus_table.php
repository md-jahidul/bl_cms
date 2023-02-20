<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconAndDescInMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->string('description_en')->after('bn_label_text')->nullable();
            $table->string('description_bn')->after('description_en')->nullable();
            $table->string('icon')->after('description_bn')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('description_en');
            $table->dropColumn('description_bn');
            $table->dropColumn('icon');
        });
    }
}
