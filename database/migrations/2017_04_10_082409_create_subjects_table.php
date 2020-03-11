<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject_name');
            $table->string('subject_code')->nullable();
            $table->string('ca_mark')->nullable()->default(0);
            $table->string('cr_mark')->nullable()->default(0);
            $table->string('mcq_mark')->nullable()->default(0);
            $table->string('pr_mark')->nullable()->default(0);
            $table->string('total_mark');
            $table->string('ca_pass_mark')->nullable()->default(0);
            $table->string('cr_pass_mark')->nullable()->default(0);
            $table->string('mcq_pass_mark')->nullable()->default(0);
            $table->string('pr_pass_mark')->nullable()->default(0);
            $table->string('total_pass_mark');
            $table->string('status');
            $table->string('subject_type');
            $table->integer('master_class_id')->unsigned();
            $table->foreign('master_class_id')->references('id')->on('master_classes')->onDelete('cascade')->onUpdate('cascade'); 
            $table->integer('group_class_id')->unsigned(); 
            $table->foreign('group_class_id')->references('id')->on('group_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('school_id');
            $table->string('year');
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
        Schema::dropIfExists('subjects');
    }
}
