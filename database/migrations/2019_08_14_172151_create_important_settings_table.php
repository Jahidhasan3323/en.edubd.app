<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportantSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('important_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('result_photo_permission')->nullable();
            $table->time('atten_start_time')->nullable();
            $table->time('atten_end_time')->nullable();
            $table->time('leave_start_time')->nullable();
            $table->time('leave_end_time')->nullable();
            $table->string('result_entry_type')->nullable();
            $table->string('class_position_identify')->nullable();
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
        Schema::dropIfExists('important_settings');
    }
}
