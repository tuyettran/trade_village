<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageCoursesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__courses_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->text('name');

            $table->integer('courses_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['courses_id', 'locale']);
            $table->foreign('courses_id')->references('id')->on('tradevillage__courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__courses_translations', function (Blueprint $table) {
            $table->dropForeign(['courses_id']);
        });
        Schema::dropIfExists('tradevillage__courses_translations');
    }
}
