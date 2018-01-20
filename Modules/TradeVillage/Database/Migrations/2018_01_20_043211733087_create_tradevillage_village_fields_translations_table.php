<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageVillage_fieldsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__village_fields_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('village_fields_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['village_fields_id', 'locale']);
            $table->foreign('village_fields_id')->references('id')->on('tradevillage__village_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__village_fields_translations', function (Blueprint $table) {
            $table->dropForeign(['village_fields_id']);
        });
        Schema::dropIfExists('tradevillage__village_fields_translations');
    }
}
