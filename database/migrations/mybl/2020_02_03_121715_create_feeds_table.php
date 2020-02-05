<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->string('type');
            $table->string('source');
            $table->string('title');
            $table->longText('description');
            $table->string('video_url')->nullable();
            $table->string('image_url')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('preview_image')->nullable();
            $table->string('custom_media_url')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamp('start_date')->default(\Carbon\Carbon::now()->toDateTimeString());
            $table->timestamp('end_date')->nullable();
            $table->string('status')->default(\App\Enums\FeedStatus::PENDING);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('approved_by')->nullable();
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
        Schema::dropIfExists('feeds');
    }
}
