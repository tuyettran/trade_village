<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageProductCommentsTranslationsTable extends Migration
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
            // $table->unique(['product_comments_id', 'locale']);
            $table->foreign('product_comments_id', 'tradevillage__product_comments_translations_pc_foreign')->references('id')->on('tradevillage__product_comments')->onDelete('cascade');
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
            $table->dropForeign(['pc']);
        });
        Schema::dropIfExists('tradevillage__product_comments_translations');
    }
}
