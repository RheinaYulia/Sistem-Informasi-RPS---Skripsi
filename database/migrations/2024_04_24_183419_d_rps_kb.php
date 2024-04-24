<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRpsKb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_rps_kb', function (Blueprint $table) {
            $table->id('kb_penilaian_id');
            $table->unsignedBigInteger('bab_id')->index();
            $table->string('kriteria_penilaian', 255)->nullable();
            $table->string('bentuk_penilaian', 255)->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('bab_id')->references('bab_id')->on('d_rps_bab');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('d_rps_kb');
    }
}
