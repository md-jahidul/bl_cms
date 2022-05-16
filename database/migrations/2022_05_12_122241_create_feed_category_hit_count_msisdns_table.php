<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedCategoryHitCountMsisdnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_category_hit_count_msisdns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('feed_category_id');
            $table->integer('msisdn')->nullable();
            $table->timestamps();
            $table->foreign('feed_category_id')
                ->references('id')
                ->on('my_bl_feed_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feed_category_hit_count_msisdns');
    }
}
