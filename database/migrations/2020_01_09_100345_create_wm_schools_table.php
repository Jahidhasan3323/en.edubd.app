<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWmSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wm_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('body_background')->nullable();
            $table->string('header_background_logo')->nullable();
            $table->string('video')->nullable();
            $table->string('content_heading_background')->nullable();
            $table->string('content_heading_color')->nullable();
            $table->string('sidebar_heading_background')->nullable();
            $table->string('sidebar_heading_color')->nullable();
            $table->string('name_color')->nullable();
            $table->text('map')->nullable();
            $table->text('copyright');
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
        Schema::dropIfExists('wm_schools');
    }
}
