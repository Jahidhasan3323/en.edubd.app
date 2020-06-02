<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWmGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wm_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->text('path');
            $table->string('tittle')->nullable();
            $table->text('details')->nullable();
            $table->integer('type');
            $table->date('date')->nullable();
            $table->integer('wm_gallery_category_id')->unsigned();
            $table->foreign('wm_gallery_category_id')->references('id')->on('wm_gallery_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('wm_galleries');
    }
}
