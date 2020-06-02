<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('top_banner_advertisement')->nullable();
            $table->string('slider_bottom_advertisement')->nullable();
            $table->string('footer_advertisement')->nullable();
            $table->string('slider_right_advertisement')->nullable();
            $table->string('slider_left_advertisement')->nullable();
            $table->string('sitebar_right_advertisement')->nullable();
            $table->string('sitebar_bottom_advertisement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisements');
    }
}
