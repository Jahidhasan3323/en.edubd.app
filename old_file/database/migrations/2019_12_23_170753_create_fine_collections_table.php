<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFineCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fine_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('fund_id')->unsigned();
            $table->foreign('fund_id')->references('id')->on('funds')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('serial');
            $table->date('payment_date');
            $table->string('payment_method')->nullable();
            $table->string('payment_by')->nullable();
            $table->string('mobile')->nullable();
            $table->float('amount', 12, 2)->default(0);
            $table->float('paid', 12, 2)->default(0);
            $table->float('waiver', 12, 2)->default(0);
            $table->float('due', 12, 2)->default(0);
            $table->string('reference')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('fine_collections');
    }
}
