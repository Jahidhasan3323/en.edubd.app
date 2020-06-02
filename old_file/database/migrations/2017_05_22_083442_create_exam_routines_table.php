<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamRoutinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_routines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('master_class_id')->unsigned();
            $table->foreign('master_class_id')->references('id')->on('master_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('group_class_id')->unsigned();
            $table->foreign('group_class_id')->references('id')->on('group_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('exam_type_id')->unsigned();
            $table->foreign('exam_type_id')->references('id')->on('exam_types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('path');
            $table->boolean('status');
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
        Schema::dropIfExists('exam_routines');
    }
}
