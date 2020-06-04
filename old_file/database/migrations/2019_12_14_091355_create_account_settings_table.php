<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id')->unsigned();
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade')->onUpdate('cascade');
            $table->string('voucher_title')->default('মেমো');
            $table->integer('provident_fund_rate')->default(0);
            $table->integer('subcategory_view')->default(0);
            $table->integer('fee_coolection_sms')->default(0);
            $table->integer('income_sms')->default(0);
            $table->integer('expense_sms')->default(0);
            $table->integer('fine_collection_sms')->default(0);
            $table->integer('absence_fine')->default(0);
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
        Schema::dropIfExists('account_settings');
    }
}
