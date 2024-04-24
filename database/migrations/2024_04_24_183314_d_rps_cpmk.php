<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRpsCpmk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_rps_cpmk', function (Blueprint $table) {
            $table->id('rps_cpmk_id');
            $table->unsignedBigInteger('rps_id')->index();
            $table->unsignedBigInteger('cpl_cpmk_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('rps_id')->references('rps_id')->on('m_rps');
            $table->foreign('cpl_cpmk_id')->references('cpl_cpmk_id')->on('t_cpl_cpmk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_rps_cpmk');
    }
}
