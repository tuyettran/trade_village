<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageProductsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__products_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->text('name');
            $table->text('description');
            $table->text('material');
            $table->longText('detail');

            $table->integer('products_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['products_id', 'locale']);
            $table->foreign('products_id')->references('id')->on('tradevillage__products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__products_translations', function (Blueprint $table) {
            $table->dropForeign(['products_id']);
        });
        Schema::dropIfExists('tradevillage__products_translations');
    }
}
