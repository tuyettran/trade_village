<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeVillageEduCourseFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tradevillage__edu_course_fields', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('course_id')->unsigned();
            $table->integer('edu_field_id')->unsigned();
            // Your fields
            $table->unique(['edu_field_id', 'course_id']);
            $table->timestamps();

            $table->foreign('course_id', 'tradevillage__edu_course_fields_c_foreign')->references('id')->on('tradevillage__courses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('edu_field_id', 'tradevillage__edu_course_fields_ef_foreign')->references('id')->on('tradevillage__edu_fields')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('tradevillage__edu_course_fields', function (Blueprint $table) {
        //     $table->dropForeign(['ef']);
        //     $table->dropForeign(['c']);
        // });
        Schema::dropIfExists('tradevillage__edu_course_fields');
    }
}
