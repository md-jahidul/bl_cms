<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSomeColumToContextualCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('contextual_cards', 'first_action_text')) {
            Schema::table('contextual_cards', function (Blueprint $table) {
                $table->dropColumn('first_action_text');
            });
        }
        if (Schema::hasColumn('contextual_cards', 'second_action_text')) {
            Schema::table('contextual_cards', function (Blueprint $table) {
                $table->dropColumn('second_action_text');
            });
        }

        if (Schema::hasColumn('contextual_cards', 'first_action')) {
            Schema::table('contextual_cards', function (Blueprint $table) {
                $table->dropColumn('first_action');
            });
        }

        if (Schema::hasColumn('contextual_cards', 'second_action')) {
            Schema::table('contextual_cards', function (Blueprint $table) {
                $table->dropColumn('second_action');
            });
        }

        if (!Schema::hasColumn('contextual_cards','navigation')) {
            Schema::table('contextual_cards', function (Blueprint $table) {
                $table->string('navigation', 255)->nullable()->after('component');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contextual_cards', function (Blueprint $table) {
            //
        });
    }
}
