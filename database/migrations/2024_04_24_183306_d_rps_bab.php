<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRpsBab extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_rps_bab', function (Blueprint $table) {
            $table->id('bab_id');
            $table->unsignedBigInteger('rps_id')->index();
            $table->integer('rps_bab')->nullable();
            $table->string('sub_cpmk',500)->nullable();
            $table->text('materi')->nullable();
            $table->string('estimasi_waktu',50)->nullable();
            $table->text('pegalaman_belajar')->nullable();
            $table->text('indikator_penilaian')->nullable();
            $table->decimal('bobot_penilaian')->nullable();
            $table->date('tanggal_penyusunan')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('rps_id')->references('rps_id')->on('m_rps');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_rps_bab');
    }
}
