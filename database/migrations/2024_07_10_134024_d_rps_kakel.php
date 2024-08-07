<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRpsKakel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_rps_kakel', function (Blueprint $table) {
        $table->id('rps_kakel_id');
        $table->unsignedBigInteger('rps_id')->nullable();
        $table->unsignedBigInteger('kakel_mk_id')->nullable();
        $table->dateTime('created_at')->nullable()->useCurrent();
        $table->integer('created_by')->nullable()->index();
        $table->dateTime('updated_at')->nullable();
        $table->integer('updated_by')->nullable()->index();
        $table->dateTime('deleted_at')->nullable()->index();
        $table->integer('deleted_by')->nullable()->index();

        $table->foreign('rps_id')->references('rps_id')->on('m_rps');
        $table->foreign('kakel_mk_id')->references('kakel_mk_id')->on('t_kakel_mk');
    });

}

/**
 * Reverse the migrations.
 *
 * @return void
 */
public function down()
{
    Schema::dropIfExists('t_kakel_mk');
}
}
