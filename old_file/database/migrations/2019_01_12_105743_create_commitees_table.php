<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommiteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commitees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->string('gender');
            $table->string('designation');
            $table->string('edu_quali');
            $table->string('join_date');
            $table->string('retire_date')->nullable();
            $table->string('birth_date');
            $table->string('blood')->nullable();
            $table->string('religion')->nullable();
            
            $table->string('nid');
            $table->string('home_name')->nullable();
            $table->string('holding_name')->nullable();
            $table->string('road_name')->nullable();
            $table->string('village');
            $table->string('post_office');
            $table->string('unione');
            $table->string('thana');
            $table->string('district');
            $table->string('post_code');
            $table->string('regine');
            $table->string('image');

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
        Schema::dropIfExists('commitees');
    }
}
