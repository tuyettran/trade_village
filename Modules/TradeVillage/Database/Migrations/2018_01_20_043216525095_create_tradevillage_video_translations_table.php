<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageVideoTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__video_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('video_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['video_id', 'locale']);
            $table->foreign('video_id')->references('id')->on('tradevillage__videos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__video_translations', function (Blueprint $table) {
            $table->dropForeign(['video_id']);
        });
        Schema::dropIfExists('tradevillage__video_translations');
    }
}
