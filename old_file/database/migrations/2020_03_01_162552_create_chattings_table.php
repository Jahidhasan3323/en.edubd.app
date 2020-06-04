<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChattingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chattings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('messasge');
            $table->boolean('read')->default(false);
            $table->text('file')->nullable();
            $table->integer('status')->default(1);
            $table->integer('from')->unsigned();
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
             $table->integer('to')->unsigned();
            $table->foreign('to')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('from_db');
            $table->integer('to_db');
            $table->softDeletes();
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
        Schema::dropIfExists('chatings');
    }
}
