<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageProductRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__product_rates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->float('value', 2, 1)->unsigned();
            // Your fields
            $table->timestamps();

            $table->foreign('product_id', 'tradevillage__product_rates_p_foreign')->references('id')->on('tradevillage__products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id', 'tradevillage__product_rates_u_foreign')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tradevillage__product_rates', function (Blueprint $table) {
        //     $table->dropForeign(['p']);
        // });

        Schema::dropIfExists('tradevillage__product_rates');
    }
}
