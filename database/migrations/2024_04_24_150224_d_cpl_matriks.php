<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DCplMatriks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_cpl_matriks', function (Blueprint $table) {
            $table->id('cpl_matriks_id');
            $table->unsignedBigInteger('cpl_sndikti_id')->index();
            $table->unsignedBigInteger('cpl_prodi_id')->index();
            $table->boolean('cpl_matriks_check')->default(0);
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('cpl_sndikti_id')->references('cpl_sndikti_id')->on('m_cpl_sndikti');
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
        Schema::dropIfExists('d_cpl_matriks');
    }
}