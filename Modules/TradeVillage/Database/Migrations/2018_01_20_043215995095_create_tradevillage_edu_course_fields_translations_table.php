<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageEduCourseFieldsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__edu_course_fields_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('edu_course_fields_id')->unsigned();
            $table->string('locale')->index();
            // $table->unique(['edu_course_fields_id', 'locale']);
            $table->foreign('edu_course_fields_id', 'tradevillage__edu_course_fields_translations_ecf_foreign')->references('id')->on('tradevillage__edu_course_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__edu_course_fields_translations', function (Blueprint $table) {
            $table->dropForeign(['ecf']);
        });
        Schema::dropIfExists('tradevillage__edu_course_fields_translations');
    }
}
