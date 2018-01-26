<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageProcessTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__process_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->longText('description');
            // Your translatable fields

            $table->integer('process_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['process_id', 'locale']);
            $table->foreign('process_id')->references('id')->on('tradevillage__processes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__process_translations', function (Blueprint $table) {
            $table->dropForeign(['process_id']);
        });
        Schema::dropIfExists('tradevillage__process_translations');
    }
}
