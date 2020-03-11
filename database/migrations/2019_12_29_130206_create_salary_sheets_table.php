<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalarySheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_sheets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('employee_id')->unsigned();
            $table->foreign('employee_id')->references('id')->on('staff')->onDelete('cascade')->onUpdate('cascade');
            $table->float('basic', 12, 2)->default(0.00);
            $table->float('basic_increase', 12, 2)->default(0.00);
            $table->float('basic_decrease', 12, 2)->default(0.00);
            $table->float('provident_fund', 12, 2)->default(0.00);
            $table->float('absent_fine', 12, 2)->default(0.00);
            $table->float('advanced_paid', 12, 2)->default(0.00);
            $table->float('net_salary', 12, 2)->default(0.00);
            $table->string('month');
            $table->string('year');
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
        Schema::dropIfExists('salary_sheets');
    }
}
