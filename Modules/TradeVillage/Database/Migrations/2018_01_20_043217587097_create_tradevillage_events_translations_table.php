<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageEventsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__events_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 100);
            $table->longText('content');
            $table->text('address');
            // Your translatable fields

            $table->integer('events_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['events_id', 'locale']);
            $table->foreign('events_id')->references('id')->on('tradevillage__events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__events_translations', function (Blueprint $table) {
            $table->dropForeign(['events_id']);
        });
        Schema::dropIfExists('tradevillage__events_translations');
    }
}
