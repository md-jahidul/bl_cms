<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusInBaseImageCtasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('base_image_ctas', function (Blueprint $table) {
            $table->string('status')->after('action_url_or_code')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('base_image_ctas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
