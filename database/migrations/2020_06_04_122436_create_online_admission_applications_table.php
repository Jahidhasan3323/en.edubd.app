<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineAdmissionApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_admission_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_bn');
            $table->string('name_en');
            $table->string('father_name_bn');
            $table->string('father_name_en');
            $table->string('mother_name_bn');
            $table->string('mother_name_en');
            $table->string('birth_certificate_no');
            $table->date('dob');
            $table->string('parents_income');
            $table->string('parents_phone');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('religion');
            $table->string('nationality');
            $table->string('parmanent_vill');
            $table->string('parmanent_post');
            $table->string('parmanent_upozila');
            $table->string('parmanent_zila');
            $table->string('present_vill');
            $table->string('present_post');
            $table->string('present_upozila');
            $table->string('present_zila');
            $table->text('picture');
            $table->text('signature');
            $table->integer('class')->nullable();
            $table->string('reg_no');
            $table->string('password');
            $table->integer('status')->default(1);
            $table->integer('type');
            $table->integer('online_admission_id');
            $table->integer('school_id');
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
        Schema::dropIfExists('online_admission_applications');
    }
}
