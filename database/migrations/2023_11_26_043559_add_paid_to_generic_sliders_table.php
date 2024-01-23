<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaidToGenericSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('generic_sliders', function (Blueprint $table) {
            $table->string('redirection_button_en')->nullable()->after('ios_version_code_max');
            $table->string('redirection_button_bn')->nullable()->after('redirection_button_en');
            $table->string('redirection_button_deeplink')->nullable()->after('redirection_button_bn');
            $table->boolean('is_card')->default(false)->after('redirection_button_deeplink');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('generic_sliders', function (Blueprint $table) {
            $table->dropColumn('redirection_button_en');
            $table->dropColumn('redirection_button_bn');
            $table->dropColumn('redirection_button_deeplink');
            $table->dropColumn('is_card');
        });
    }
}
