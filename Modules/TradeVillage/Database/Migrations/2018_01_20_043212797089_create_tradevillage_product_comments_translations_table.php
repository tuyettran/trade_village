<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageProduct_commentsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__product_comments_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('product_comments_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['product_comments_id', 'locale']);
            $table->foreign('product_comments_id')->references('id')->on('tradevillage__product_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__product_comments_translations', function (Blueprint $table) {
            $table->dropForeign(['product_comments_id']);
        });
        Schema::dropIfExists('tradevillage__product_comments_translations');
    }
}
