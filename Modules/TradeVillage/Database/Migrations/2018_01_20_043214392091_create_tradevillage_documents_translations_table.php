<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageDocumentsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__documents_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 100);
            $table->text('author');
            // Your translatable fields

            $table->integer('documents_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['documents_id', 'locale']);
            $table->foreign('documents_id')->references('id')->on('tradevillage__documents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tradevillage__documents_translations', function (Blueprint $table) {
            $table->dropForeign(['documents_id']);
        });
        Schema::dropIfExists('tradevillage__documents_translations');
    }
}
