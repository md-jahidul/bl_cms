<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndChangeColumnInTriviaGamificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trivia_gamifications', function (Blueprint $table) {
            $table->string('content_for')->change();
            $table->boolean('status')->default(1)->after('content_for');
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
            $table->json('content_for')->change();
            $table->dropColumn('status');
        });
    }
}
