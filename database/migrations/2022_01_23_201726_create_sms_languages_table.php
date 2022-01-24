<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('feature', 20)->index();
            $table->string('default_lang', 20);
            $table->string('sms_en');
            $table->text('sms_bn');
            $table->string('concat_char', 1);
            $table->tinyInteger('status');
            $table->string('platform', 25)->default('mybl');
            $table->string('updated_by');

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
        Schema::dropIfExists('sms_languages');
    }
}
