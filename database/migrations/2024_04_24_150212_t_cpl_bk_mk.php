<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCplBkMk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_cpl_bk_mk', function (Blueprint $table) {
            $table->id('cpl_bk_mk_id');
            $table->unsignedBigInteger('mk_id')->index();
            $table->unsignedBigInteger('cpl_bk_id')->index();
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('cpl_bk_id')->references('cpl_bk_id')->on('t_cpl_bk');
            $table->foreign('cpl_prodi_id')->references('cpl_prodi_id')->on('m_cpl_prodi');
            $table->foreign('mk_id')->references('mk_id')->on('m_mk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_cpl_bk_mk');
    }
}