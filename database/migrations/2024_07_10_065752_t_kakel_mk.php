<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TKakelMk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_kakel_mk', function (Blueprint $table) {
            $table->id('kakel_mk_id');
            $table->unsignedBigInteger('d_kakel_id')->nullable();
            $table->unsignedBigInteger('kurikulum_mk_id')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('d_kakel_id')->references('d_kakel_id')->on('d_kakel');
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
        Schema::dropIfExists('t_kakel_mk');
    }
}
