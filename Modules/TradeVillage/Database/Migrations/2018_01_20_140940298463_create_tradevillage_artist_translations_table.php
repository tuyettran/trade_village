<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageArtistTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__artist_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 100);
            $table->text('description');
            $table->longText('detail');
            $table->text('address');
            // Your translatable fields

            $table->integer('artist_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['artist_id', 'locale']);
            $table->foreign('artist_id')->references('id')->on('tradevillage__artists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__artist_translations', function (Blueprint $table) {
            $table->dropForeign(['artist_id']);
        });
        Schema::dropIfExists('tradevillage__artist_translations');
    }
}
