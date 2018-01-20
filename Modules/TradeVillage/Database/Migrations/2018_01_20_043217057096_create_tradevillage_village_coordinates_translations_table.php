<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageVillage_coordinatesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__village_coordinates_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('village_coordinates_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['village_coordinates_id', 'locale']);
            $table->foreign('village_coordinates_id')->references('id')->on('tradevillage__village_coordinates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__village_coordinates_translations', function (Blueprint $table) {
            $table->dropForeign(['village_coordinates_id']);
        });
        Schema::dropIfExists('tradevillage__village_coordinates_translations');
    }
}
