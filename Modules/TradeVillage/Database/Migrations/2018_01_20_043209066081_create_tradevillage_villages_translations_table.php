<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageVillagesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__villages_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->text('name');
            $table->text('description');
            $table->text('image');
            $table->text('story');
            $table->longText('detail');
            $table->text('address');

            $table->integer('villages_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['villages_id', 'locale']);
            $table->foreign('villages_id')->references('id')->on('tradevillage__villages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__villages_translations', function (Blueprint $table) {
            $table->dropForeign(['villages_id']);
        });
        Schema::dropIfExists('tradevillage__villages_translations');
    }
}
