<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddLoginButtonTitleBnToWelcomeInfoTable
 */
class AddLoginButtonTitleBnToWelcomeInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('welcome_info', function (Blueprint $table) {
            $table->string('login_button_title_bn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('welcome_info', function (Blueprint $table) {
            $table->dropColumn('login_button_title_bn');
        });
    }
}
