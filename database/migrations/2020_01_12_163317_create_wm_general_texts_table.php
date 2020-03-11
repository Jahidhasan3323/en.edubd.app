<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWmGeneralTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wm_general_texts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('file')->nullable();
            $table->string('tittle')->nullable();
            $table->text('speech')->nullable();
            $table->integer('wm_general_text_type_id')->unsigned();
            $table->foreign('wm_general_text_type_id')->references('id')->on('wm_general_text_types')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wm_general_texts');
    }
}
