<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__videos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('link');
            $table->integer('course_id')->unsigned();
            $table->integer('chapter')->unsigned();

            // Your fields
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('tradevillage__courses')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tradevillage__videos', function (Blueprint $table) {
        //     $table->dropForeign(['course_id']);
        // });
        Schema::dropIfExists('tradevillage__videos');
    }
}
