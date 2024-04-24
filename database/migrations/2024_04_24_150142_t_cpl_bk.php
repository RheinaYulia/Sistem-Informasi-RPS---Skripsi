<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCplBk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_cpl_bk', function (Blueprint $table) {
            $table->id('cpl_bk_id');
            $table->unsignedBigInteger('bk_id')->index();
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('bk_id')->references('bk_id')->on('m_bahan_kajian');
            $table->foreign('cpl_prodi_id')->references('cpl_prodi_id')->on('m_cpl_prodi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_rumpun_mk');
    }
}