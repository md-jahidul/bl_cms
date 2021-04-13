<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconIdToContextualCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('contextual_cards','icon_id')) {
            Schema::table('contextual_cards', function (Blueprint $table) {
                $table->integer('icon_id')->nullable()->after('image_url');
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
        if (Schema::hasColumn('contextual_cards', 'icon_id')) {
            Schema::table('contextual_cards', function (Blueprint $table) {
                $table->dropColumn('icon_id');
            });
        }
    }
}
