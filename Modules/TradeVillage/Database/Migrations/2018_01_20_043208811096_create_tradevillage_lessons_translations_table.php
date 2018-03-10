<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradevillageLessonsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__lessons_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->String('name');
            $table->text('description');
            // Your translatable fields

            $table->integer('lessons_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['lessons_id', 'locale']);
            $table->foreign('lessons_id')->references('id')->on('tradevillage__lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__lessons_translations', function (Blueprint $table) {
            $table->dropForeign(['lessons_id']);
        });
        Schema::dropIfExists('tradevillage__lessons_translations');
    }
}
