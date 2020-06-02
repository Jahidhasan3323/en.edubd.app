<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ca_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exam_type_id')->unsigned();
            $table->foreign('exam_type_id')->references('id')->on('exam_types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('exam_year');
            $table->string('subject_id');
            $table->string('subject_name');
            $table->string('total_mark');
            $table->string('pass_mark');
            $table->integer('master_class_id')->unsigned();
            $table->foreign('master_class_id')->references('id')->on('master_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('group_class_id')->unsigned();
            $table->foreign('group_class_id')->references('id')->on('group_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('shift');
            $table->string('section');
            $table->string('student_id');
            $table->string('roll');
            $table->string('marks');
            $table->string('gpa');
            $table->string('grade_latter');
            $table->string('author_by');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ca_results');
    }
}
