<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('exam_type_id')->unsigned();
        $table->foreign('exam_type_id')->references('id')->on('exam_types')->onDelete('cascade')->onUpdate('cascade');
        $table->string('exam_year');
        $table->string('student_id');
        $table->string('regularity')->default('নিয়মিত');
        $table->string('roll');
        $table->integer('master_class_id')->unsigned();
        $table->foreign('master_class_id')->references('id')->on('master_classes')->onDelete('cascade')->onUpdate('cascade');
        $table->integer('group_class_id')->unsigned();
        $table->foreign('group_class_id')->references('id')->on('group_classes')->onDelete('cascade')->onUpdate('cascade');
        $table->string('shift');
        $table->string('section');
        $table->bigInteger('subject_id');
        $table->string('subject_name');
        $table->string('ca_mark');
        $table->string('cr_mark');
        $table->string('mcq_mark');
        $table->string('pr_mark');
        $table->string('sub_total');
        $table->string('ca_pass_mark');
        $table->string('cr_pass_mark');
        $table->string('mcq_pass_mark');
        $table->string('pr_pass_mark');
        $table->string('total_pass_mark');
        $table->string('total_mark');
        $table->string('subject_type');
        $table->string('subject_status');
        $table->integer('school_id')->unsigned();
        $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
        $table->string('author_by');
        $table->boolean('status');
        $table->string('grand_total_mark');
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
        Schema::dropIfExists('results');
    }
}
