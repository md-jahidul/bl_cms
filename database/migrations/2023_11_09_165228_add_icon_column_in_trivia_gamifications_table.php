<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIconColumnInTriviaGamificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trivia_gamifications', function (Blueprint $table) {
            $table->string('icon')->after('banner')->nullable();
            $table->boolean('is_title_show')->after('icon')->default(false);
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
            $table->dropColumn('icon');
            $table->dropColumn('is_title_show');
        });
    }
}
