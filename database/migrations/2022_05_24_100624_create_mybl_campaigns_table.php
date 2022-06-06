<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyblCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mybl_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('base_msisdn_groups_id')->nullable()->index();
            $table->string('campaign_user_type');
            $table->string('title');
            $table->string('campaign_type');
            $table->string('purchase_eligibility');
            $table->string('recurring_type')->default('none');
            $table->integer('number_of_apply_times')->nullable();
            $table->integer('max_amount')->nullable();
            $table->string('reword_getting_type')->nullable();
            $table->string('payment_gateway');
            $table->string('winning_type');
//            $table->string('description_bn');
//            $table->string('description_en');
//            $table->dateTime('start_date')->nullable();
//            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('mybl_campaigns');
    }
}
