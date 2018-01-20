<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageEnterprisesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__enterprises_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('enterprises_id')->unsigned();
            $table->string('locale')->index();
            // $table->unique(['enterprises_id', 'locale']);
            $table->foreign('enterprises_id')->references('id')->on('tradevillage__enterprises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__enterprises_translations', function (Blueprint $table) {
            $table->dropForeign(['enterprises_id']);
        });
        Schema::dropIfExists('tradevillage__enterprises_translations');
    }
}
