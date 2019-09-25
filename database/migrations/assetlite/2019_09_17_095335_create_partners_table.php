<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('partner_category_id');
            $table->string('company_name_en');
            $table->string('company_name_bn');
            $table->string('company_logo');
            $table->text('company_address');
            $table->string('company_website');
            $table->string('contact_person_name');
            $table->string('contact_person_email');
            $table->string('contact_person_mobile');
            $table->string('is_active');
            $table->text('other_attributes');
            $table->foreign('partner_category_id')
                ->references('id')
                ->on('partner_categories')
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
        Schema::dropIfExists('partners');
    }
}
