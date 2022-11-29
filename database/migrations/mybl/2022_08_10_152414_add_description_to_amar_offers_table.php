<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionToAmarOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amar_offers', function (Blueprint $table) {
            $table->string('user_group_type')->nullable()->after('name');
            $table->unsignedBigInteger('base_groups_id')->nullable()->after('user_group_type');
            $table->text('description')->after('validity_unit');
            $table->boolean('status')->default(0)->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amar_offers', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('status');
        });
    }
}
