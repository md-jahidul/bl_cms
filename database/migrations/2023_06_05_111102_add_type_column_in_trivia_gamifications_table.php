<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColumnInTriviaGamificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trivia_gamifications', function (Blueprint $table) {
            $table->string('type')->nullable()->after('show_answer_btn_bn');
            $table->string('rule_name')->nullable()->after('type');
            $table->json('content_for')->nullable()->after('rule_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trivia_gamifications', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('rule_name');
            $table->dropColumn('content_for');
        });
    }
}
