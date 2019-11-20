<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerOfferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_offer_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('partner_offer_id');
            $table->text('details_en')->nullable();
            $table->text('details_bn')->nullable();
            $table->text('offer_details_en')->nullable();
            $table->text('offer_details_bn')->nullable();
            $table->string('eligible_customer_en')->nullable();
            $table->string('eligible_customer_bn')->nullable();
            $table->string('avail_en')->nullable();
            $table->string('avail_bn')->nullable();

            $table->foreign('partner_offer_id')
                ->references('id')
                ->on('partner_offers')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
        Schema::dropIfExists('partner_offer_details');
    }
}
