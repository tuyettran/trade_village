<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageCourseCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__course_comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->timestamps();


            $table->foreign('course_id', 'tradevillage__course_comments_c_foreign')->references('id')->on('tradevillage__courses')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('user_id', 'tradevillage__course_comments_u_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tradevillage__course_comments', function (Blueprint $table) {
        //     $table->dropForeign(['c']);
        // });

        Schema::dropIfExists('tradevillage__course_comments');
    }
}