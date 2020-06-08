<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineAdmissionAccademicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_admission_accademic_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('exam_name');
            $table->string('roll_no');
            $table->string('registration_no');
            $table->string('board');
            $table->string('institute');
            $table->string('passing_year');
            $table->string('gpa');
            $table->string('status')->default(1);
            $table->integer('o_a_application_id');
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
        Schema::dropIfExists('online_admission_accademic_infos');
    }
}
