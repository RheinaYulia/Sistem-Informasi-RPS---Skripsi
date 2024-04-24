<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRpsBk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_rps_bk', function (Blueprint $table) {
            $table->id('rps_bk_id');
            $table->unsignedBigInteger('rps_id')->index();
            $table->unsignedBigInteger('mk_bk_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('rps_id')->references('rps_id')->on('m_rps');
            $table->foreign('mk_bk_id')->references('mk_bk_id')->on('t_mk_bk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_rps_bk');
    }
}
