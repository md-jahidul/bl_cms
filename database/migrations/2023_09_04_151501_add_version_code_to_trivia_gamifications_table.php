<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVersionCodeToTriviaGamificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trivia_gamifications', function (Blueprint $table) {
            $table->bigInteger('android_version_code_min')->default(0)->after('content_for');
            $table->bigInteger('android_version_code_max')->default(999999999)->after('android_version_code_min');
            $table->bigInteger('ios_version_code_min')->default(0)->after('android_version_code_max');
            $table->bigInteger('ios_version_code_max')->default(999999999)->after('ios_version_code_min');
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
            $table->dropColumn('android_version_code_min');
            $table->dropColumn('android_version_code_max');
            $table->dropColumn('ios_version_code_min');
            $table->dropColumn('ios_version_code_max');
        });
    }
}
