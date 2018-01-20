<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageEdu_fieldsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__edu_fields_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('edu_fields_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['edu_fields_id', 'locale']);
            $table->foreign('edu_fields_id')->references('id')->on('tradevillage__edu_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__edu_fields_translations', function (Blueprint $table) {
            $table->dropForeign(['edu_fields_id']);
        });
        Schema::dropIfExists('tradevillage__edu_fields_translations');
    }
}
