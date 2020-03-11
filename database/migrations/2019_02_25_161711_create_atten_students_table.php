<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttenStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atten_students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status',10)->comment('A for Absent, P for Present, L for Leave, H for Holyday');
            $table->string('student_id',100);
            $table->integer('master_class_id')->unsigned();
            $table->foreign('master_class_id')->references('id')->on('master_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('group',50);
            $table->string('section',20);
            $table->string('shift',50);
            $table->string('roll',50);
            $table->string('session',50);
            $table->string('regularity',100);
            $table->time('in_time',0)->nullable();
            $table->time('out_time',0)->nullable();
            $table->date('date');
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
        Schema::dropIfExists('atten_students');
    }
}
