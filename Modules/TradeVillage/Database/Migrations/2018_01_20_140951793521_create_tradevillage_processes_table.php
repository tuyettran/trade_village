<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__processes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('step')->unsigned();
            // Your fields
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('tradevillage__products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tradevillage__process', function (Blueprint $table) {
        //     $table->dropForeign(['product_id']);
        // });
        Schema::dropIfExists('tradevillage__processes');
    }
}
