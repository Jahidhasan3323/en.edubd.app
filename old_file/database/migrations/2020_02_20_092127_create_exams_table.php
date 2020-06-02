<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('full_mark');
            $table->double('pass_mark')->nullable();
            $table->double('time');
            $table->integer('result_type')->nullable()->comment('1 grade. 2 normal');
            $table->string('shift');
            $table->string('section');
            $table->integer('type')->comment('1 mcq. 2 written');
            $table->integer('exam_option')->nullable()->comment('1 one. 2 many');
            $table->integer('exam_type')->comment('1 online. 2 offline');
            $table->integer('subject_id')->unsigned();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('group_class_id')->unsigned();
            $table->foreign('group_class_id')->references('id')->on('group_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('master_class_id')->unsigned();
            $table->foreign('master_class_id')->references('id')->on('master_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('exams');
    }
}
