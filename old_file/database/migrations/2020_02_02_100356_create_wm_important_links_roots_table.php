<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWmImportantLinksRootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wm_important_links_roots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tittle');
            $table->string('link');
            $table->integer('header_status');
            $table->string('school_type_id');
            $table->integer('wm_important_links_category_root_id')->unsigned();
            $table->foreign('wm_important_links_category_root_id','imp_links_ctg_root')->references('id')->on('wm_important_links_category_roots')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('wm_important_links_roots');
    }
}
