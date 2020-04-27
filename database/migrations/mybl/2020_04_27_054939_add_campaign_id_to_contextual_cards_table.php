<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCampaignIdToContextualCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contextual_cards', function (Blueprint $table) {
            $table->string('campaign_id')->nullable()->after('description');
            $table->string('url')->nullable()->after('campaign_id');
            $table->string('component')->nullable()->after('url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contextual_cards', function (Blueprint $table) {
            $table->dropColumn('campaign_id');
            $table->dropColumn('url');
            $table->dropColumn('component');
        });
    }
}
