<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks_withdraws', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serial')->default(20191000);
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('bank_id')->unsigned();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('account_type_id')->default(0);
            $table->string('account_number');
            $table->string('check_number')->nullable();
            $table->float('amount', 12, 2)->default(0.00);
            $table->string('withdraw_by')->nullable();
            $table->text('purpose')->nullable();
            $table->text('description')->nullable();
            $table->date('withdra_date')->nullable();
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
        Schema::dropIfExists('banks_withdraws');
    }
}
