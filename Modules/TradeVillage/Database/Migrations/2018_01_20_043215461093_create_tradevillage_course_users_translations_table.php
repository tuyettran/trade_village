<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageCourseUsersTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__course_users_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('course_users_id')->unsigned();
            $table->string('locale')->index();
            // $table->unique(['course_users_id', 'locale']);
            $table->foreign('course_users_id', 'cu_foreign')->references('id')->on('tradevillage__course_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__course_users_translations', function (Blueprint $table) {
            $table->dropForeign(['course_users_id']);
        });
        Schema::dropIfExists('tradevillage__course_users_translations');
    }
}
