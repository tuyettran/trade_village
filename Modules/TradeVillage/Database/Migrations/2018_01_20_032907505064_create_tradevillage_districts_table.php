<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradevillagedistrictsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__districts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->String('name');
            $table->integer('province_id')->unsigned();
            $table->timestamps();

           $table->foreign('province_id', 'tradevillage__districts_pi_foreign')->references('id')->on('tradevillage__provinces')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tradevillage__districts');
    }
}
