<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TCplCpmk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_cpl_cpmk', function (Blueprint $table) {
            $table->id('cpl_cpmk_id');
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->unsignedBigInteger('cpmk_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('cpl_prodi_id')->references('cpl_prodi_id')->on('m_cpl_prodi');
            $table->foreign('cpmk_id')->references('cpmk_id')->on('d_cpmk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_cpl_cpmk');
    }
}
