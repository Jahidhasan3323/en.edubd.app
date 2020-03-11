<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('gender');
            $table->integer('designation_id')->unsigned();
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade')->onUpdate('cascade');
            $table->string('type');
            $table->string('salary');
            $table->string('subject');
            $table->string('edu_qulif')->nullable();
            $table->string('training')->nullable();
            $table->string('joining_date')->nullable();
            $table->string('retirement_date')->nullable();
            $table->string('index_no')->nullable();
            $table->string('date_of_mpo')->nullable();
            $table->string('staff_id');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->string('birthday')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('religion')->nullable();
            $table->string('nid_card_no')->nullable();
            $table->string('last_org_name')->nullable();
            $table->string('reason_to_leave')->nullable();
            $table->string('last_org_address')->nullable();
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
            $table->string('m_edu_c')->nullable();
            $table->string('m_mobile_no')->nullable();
            $table->string('m_email')->nullable();
            $table->string('m_nid')->nullable();
            $table->string('h_w_name')->nullable();
            $table->string('profession')->nullable();
            $table->string('wedding_date')->nullable();
            $table->string('h_w_edu_qulif')->nullable();
            $table->string('h_w_nid_no')->nullable();
            $table->string('h_w_mobile_no')->nullable();
            $table->string('kids')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('staff');
    }
}
