<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHealthHubPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_hub_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('package_id');
            $table->unsignedBigInteger('health_hub_partner_id');
            $table->unsignedBigInteger('health_hub_plan_id');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('logo');
            $table->string('callback_url');
            $table->string('subscription_url');
            $table->string('allowed_customer');
            $table->text('details_en');
            $table->text('details_bn');
            $table->boolean('status');
            $table->timestamps();
            $table->foreign('health_hub_partner_id')
                ->references('id')
                ->on('health_hub_partners')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('health_hub_plan_id')
                ->references('id')
                ->on('health_hub_plans')
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
        Schema::dropIfExists('health_hub_packages');
    }
}
