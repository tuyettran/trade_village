<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__documents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('chapter')->unsigned();
            $table->integer('lesson_id')->unsigned();
            $table->string('file')->nullable($value = false);
            // Your fields
            $table->timestamps();

            $table->foreign('lesson_id')->references('id')->on('tradevillage__lessons')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tradevillage__documents', function (Blueprint $table) {
        //     $table->dropForeign(['course_id']);
        // });

        Schema::dropIfExists('tradevillage__documents');
    }
}
