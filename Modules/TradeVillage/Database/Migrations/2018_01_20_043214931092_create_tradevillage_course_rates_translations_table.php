<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageCourseRatesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__course_rates_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('course_rates_id')->unsigned();
            $table->string('locale')->index();
            // $table->unique(['course_rates_id', 'locale']);
            $table->foreign('course_rates_id', 'tradevillage__course_rates_translations_cr_foreign')->references('id')->on('tradevillage__course_rates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__course_rates_translations', function (Blueprint $table) {
            $table->dropForeign(['cr']);
        });
        Schema::dropIfExists('tradevillage__course_rates_translations');
    }
}
