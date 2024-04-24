<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MCplSndikti extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_cpl_sndikti', function (Blueprint $table) {
            $table->id('cpl_sndikti_id');
            $table->unsignedBigInteger('prodi_id')->index();
            $table->string('cpl_sndikti_kode', 5)->index();
            $table->string('cpl_sndikti_kategori', 100)->nullable();
            $table->text('cpl_sndikti_deskripsi')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('prodi_id')->references('prodi_id')->on('m_prodi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_cpl_sndikti');
    }
}