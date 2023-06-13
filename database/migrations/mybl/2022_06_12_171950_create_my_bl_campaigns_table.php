<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBlCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_bl_campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mybl_campaign_section_id');
            $table->unsignedBigInteger('base_groups_id')->nullable();
            $table->unsignedBigInteger('exclude_base_groups_id')->nullable();
            $table->boolean('first_sign_up_user')->default(0);
            $table->string('user_group_type')->nullable();
            $table->string('name');
            $table->string('type')->index();
            $table->string('winning_type')->nullable();
            $table->tinyInteger('winning_interval')->nullable();
            $table->string('winning_interval_unit', 5)->nullable();
            $table->text('winning_title')->nullable();
            $table->text('winning_massage_en')->nullable();
            $table->string('reward_bonus_code')->nullable();
            $table->string('deno_type')->nullable();
            $table->string('recurring_type')->nullable();
            $table->string('reward_getting_type')->nullable();
            $table->string('bonus_reward_type')->nullable();
            $table->string('bonus_product_code')->nullable();
            $table->integer('number_of_apply_times')->nullable();
            $table->integer('max_amount')->nullable();
            $table->string('purchase_eligibility')->nullable();
            $table->json('payment_gateways')->nullable();
            $table->string('payment_channels')->nullable();
            $table->dateTime('start_date')->nullable()->index();
            $table->dateTime('end_date')->nullable()->index();
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('mybl_campaign_section_id')
                ->references('id')
                ->on('my_bl_campaign_sections')
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
        Schema::dropIfExists('my_bl_campaigns');
    }
}
