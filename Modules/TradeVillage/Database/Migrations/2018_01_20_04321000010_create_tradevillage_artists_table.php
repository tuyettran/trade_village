<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__artists', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('date_of_birth');
            $table->integer('user_id')->nullable();
            $table->integer('village_id')->unsigned();
            $table->text('contact');
            // Your fields
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
        // Schema::table('tradevillage__artists', function (Blueprint $table) {
        //     $table->dropForeign(['village_id']);
        // });

        Schema::dropIfExists('tradevillage__artists');
    }
}
