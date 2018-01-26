<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageLinksTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__links_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->text('title');

            $table->integer('links_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['links_id', 'locale']);
            $table->foreign('links_id')->references('id')->on('tradevillage__links')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__links_translations', function (Blueprint $table) {
            $table->dropForeign(['links_id']);
        });
        Schema::dropIfExists('tradevillage__links_translations');
    }
}
