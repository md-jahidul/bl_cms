<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsDeleteToAgentDeeplinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('agent_deeplinks','is_delete')) {
            Schema::table('agent_deeplinks', function (Blueprint $table) {
                $table->string('is_delete')->nullable(false)->default(0)->after('buy_attempt');
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
        if (Schema::hasColumn('agent_deeplinks', 'is_delete')) {
            Schema::table('agent_deeplinks', function (Blueprint $table) {
                $table->dropColumn('is_delete');
            });
        }
    }
}
