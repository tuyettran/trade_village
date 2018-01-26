<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('village_id')->unsigned();
            $table->text('link');
            $table->timestamps();

            $table->foreign('village_id')->references('id')->on('tradevillage__villages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tradevillage__links', function (Blueprint $table) {
        //     $table->dropForeign(['village_id']);
        // });

        Schema::dropIfExists('tradevillage__links');
    }
}
