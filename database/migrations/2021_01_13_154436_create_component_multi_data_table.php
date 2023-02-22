<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentMultiDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('component_multi_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('component_id')->default(0);
            $table->string('page_type')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_bn')->nullable();
            $table->mediumText('details_en')->nullable();
            $table->mediumText('details_bn')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('alt_text_bn')->nullable();
            $table->string('base_image')->nullable();
            $table->string('img_name_en')->nullable();
            $table->string('img_name_bn')->nullable();
            $table->json('other_attr')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();

            $table->foreign('component_id')
                ->references('id')
                ->on('components')
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
        Schema::dropIfExists('component_multi_data');
    }
}
