<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageEnterprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__enterprises', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('website')->nullable();
            $table->integer('village_id')->unsigned();
            $table->integer('user_id')->nullable();
            $table->text('image');
            $table->double('lat', 20, 17);
            $table->double('lng', 20, 17);
            $table->text('contact');
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
        // Schema::table('tradevillage__enterprises', function (Blueprint $table) {
        //     $table->dropForeign(['village_id']);
        // });

        Schema::dropIfExists('tradevillage__enterprises');
    }
}
