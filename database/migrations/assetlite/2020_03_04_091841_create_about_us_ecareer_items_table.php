<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutUsEcareerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us_ecareer_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('about_us_ecareers_id');
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_bn')->nullable();
            $table->string('image')->nullable();
            $table->string('video', 2000)->nullable();
            $table->string('alt_text')->nullable();
            $table->string('alt_links')->nullable();
            $table->string('call_to_action', 2000)->nullable();
            $table->json('additional_info')->nullable();
            $table->tinyInteger('is_active')->default(1)->comment('active = 1, inactive = 0');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('about_us_ecareers_id')
                ->references('id')
                ->on('about_us_ecareers')
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
        Schema::dropIfExists('about_us_ecareer_items');
    }
}
