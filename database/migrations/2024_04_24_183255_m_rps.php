<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MRps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rps', function (Blueprint $table) {
            $table->id('rps_id');
            $table->unsignedBigInteger('kaprodi_id')->index();
            $table->unsignedBigInteger('kurikulum_mk_id')->index();
            $table->text('deskripsi_rps')->index();
            $table->date('tanggal_penyusunan')->nullable();
            $table->tinyInteger('verifikasi')->default(0);
            $table->tinyInteger('pengesahan')->default(0);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('kaprodi_id')->references('kaprodi_id')->on('d_kaprodi');
            $table->foreign('kurikulum_mk_id')->references('kurikulum_mk_id')->on('d_kurikulum_mk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_rps');
    }
}
