<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_limits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('notification')->nullable()->comment('Monthly');
            $table->integer('result')->nullable()->comment('Yearly per Student');
            $table->integer('due_sms')->nullable()->comment('Monthly per Student');
            $table->integer('fee_collection')->nullable()->comment('Monthly per Student');
            $table->integer('fine_collection')->nullable()->comment('Monthly per Student');
            $table->integer('income')->nullable()->comment('Monthly');
            $table->integer('expense')->nullable()->comment('Monthly');
            $table->integer('fine_due_sms')->nullable()->comment('Monthly per Student');
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
        Schema::dropIfExists('sms_limits');
    }
}
