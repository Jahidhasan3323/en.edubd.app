<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('gender')->nullable();
            $table->integer('master_class_id')->unsigned();
            $table->foreign('master_class_id')->references('id')->on('master_classes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('shift')->nullable();
            $table->string('section')->nullable();
            $table->string('group')->nullable();
            $table->string('roll')->nullable();
            $table->string('session')->nullable();
            $table->string('student_id')->nullable();
            $table->boolean('id_card_exits')->default(1);
            $table->string('birthday')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->string('birth_rg_no')->nullable();
            $table->string('last_sd_org')->nullable();
            $table->string('re_to_lve')->nullable();
            $table->string('pre_address')->nullable();
            $table->string('Pre_h_no')->nullable();
            $table->string('pre_ro_no')->nullable();
            $table->string('pre_vpm')->nullable();
            $table->string('pre_poff')->nullable();
            $table->string('pre_unim')->nullable();
            $table->string('pre_subd')->nullable();
            $table->string('pre_district')->nullable();
            $table->string('pre_postc')->nullable();
            $table->string('per_address')->nullable();
            $table->string('per_h_no')->nullable();
            $table->string('per_ro_no')->nullable();
            $table->string('per_vpm')->nullable();
            $table->string('per_poff')->nullable();
            $table->string('per_unim')->nullable();
            $table->string('per_subd')->nullable();
            $table->string('per_district')->nullable();
            $table->string('per_postc')->nullable();
            $table->string('father_name')->nullable();
            $table->string('f_career')->nullable();
            $table->string('f_m_income')->nullable();
            $table->string('f_edu_c')->nullable();
            $table->string('f_mobile_no')->nullable();
            $table->string('f_email')->nullable();
            $table->string('f_nid')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('m_career')->nullable();
            $table->string('m_m_income')->nullable();
            $table->string('m_edu_quali')->nullable();
            $table->string('m_mobile_no')->nullable();
            $table->string('m_email')->nullable();
            $table->string('m_nid')->nullable();
            $table->string('local_gar')->nullable();
            $table->string('career')->nullable();
            $table->string('relation')->nullable();
            $table->string('guardian_edu')->nullable();
            $table->string('guardian_mobile')->nullable();
            $table->string('guardian_email')->nullable();
            $table->string('guardian_nid')->nullable();
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('photo')->nullable();
            $table->string('f_photo')->nullable();
            $table->string('m_photo')->nullable();
            $table->timestamp('sms_date')->nullable();
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
        Schema::dropIfExists('students');
    }
}
