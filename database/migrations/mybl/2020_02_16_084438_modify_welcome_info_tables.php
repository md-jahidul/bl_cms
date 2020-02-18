<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class ModifyWelcomeInfoTables
 */
class ModifyWelcomeInfoTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('welcome_info', function (Blueprint $table) {
            $table->renameColumn('icon', 'image');
            $table->renameColumn('guest_message', 'message_en');
            $table->renameColumn('user_message', 'message_bn');
            $table->dropColumn(['guest_salutation', 'user_salutation']);
            $table->string('login_button_title')->after('icon');
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
            $table->renameColumn('image', 'icon');
            $table->renameColumn('message_en', 'guest_message');
            $table->renameColumn('message_bn', 'user_message');

            $table->string('guest_salutation')->nullable();
            $table->string('user_salutation')->nullable();

            $table->dropColumn('login_button_title');
        });
    }
}
