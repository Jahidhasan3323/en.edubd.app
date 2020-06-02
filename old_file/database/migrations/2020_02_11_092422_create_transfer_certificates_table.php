<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('village');
            $table->string('post_office');
            $table->string('upazila');
            $table->string('district');
            $table->string('reg_no');
            $table->string('from_session');
            $table->string('to_session');
            $table->date('birth_day');
            $table->string('shift');
            $table->string('section');
            $table->string('group');
            $table->string('previous_class');
            $table->string('tc_reg_no');
            $table->string('is_pass');
            $table->string('from_pay_session');
            $table->string('to_pay_session');
            $table->text('tc_cause');
            $table->date('date');
            $table->date('leave_date');
            $table->integer('master_class_id')->unsigned();
            $table->foreign('master_class_id')->references('id')->on('master_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->string('student_id')->unique();
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
        Schema::dropIfExists('transfer_certificates');
    }
}
