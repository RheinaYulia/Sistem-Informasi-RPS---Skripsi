<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DRpsSubCpmk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_rps_sub_cpmk', function (Blueprint $table) {
            $table->id('rps_sub_cpmk_id');
            $table->unsignedBigInteger('bab_id')->index();
            $table->unsignedBigInteger('cpmk_detail_id')->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('bab_id')->references('bab_id')->on('d_rps_bab');
            $table->foreign('cpmk_detail_id')->references('cpmk_detail_id')->on('d_cpmk_detail');
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

