<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblOrangeClubBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_orange_club_banners', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('image_url');
            $table->string('component_identifier');
            $table->string('redirect_url')->nullable();
            $table->string('partner_details')->nullable();
            $table->integer('display_order');
            $table->string('user_group_type')->nullable();
            $table->bigInteger('base_groups_id')->nullable();
            $table->boolean('status')->default(0);
            $table->json('other_attributes')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mybl_orange_club_banners');
    }
}
