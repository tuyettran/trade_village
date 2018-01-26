<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageProductRateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__product_rate_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields

            $table->integer('product_rate_id')->unsigned();
            $table->string('locale')->index();
            // $table->unique(['product_rate_id', 'locale']);
            $table->foreign('product_rate_id', 'tradevillage__product_rate_translations_pr_foreign')->references('id')->on('tradevillage__product_rates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__product_rate_translations', function (Blueprint $table) {
            $table->dropForeign(['pr']);
        });
        Schema::dropIfExists('tradevillage__product_rate_translations');
    }
}