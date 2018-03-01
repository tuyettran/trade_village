<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageVillageCoordinatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__village_coordinates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('village_id')->unsigned();
            $table->text('lat');
            $table->text('lng');
            // Your fields
            $table->timestamps();


            $table->foreign('village_id', 'tradevillage__village_coordinates_v_foreign')->references('id')->on('tradevillage__villages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tradevillage__village_coordinates', function (Blueprint $table) {
        //     $table->dropForeign(['v']);
        // });

        Schema::dropIfExists('tradevillage__village_coordinates');
    }
}
