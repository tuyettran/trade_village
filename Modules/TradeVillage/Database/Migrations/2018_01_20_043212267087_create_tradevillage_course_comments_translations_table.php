<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageCourseCommentsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__course_comments_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('course_comments_id')->unsigned();
            $table->string('locale')->index();
            // $table->unique(['course_comments_id', 'locale']);
            $table->foreign('course_comments_id', 'cc_foreign')->references('id')->on('tradevillage__course_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__course_comments_translations', function (Blueprint $table) {
            $table->dropForeign(['course_comments_id']);
        });
        Schema::dropIfExists('tradevillage__course_comments_translations');
    }
}
