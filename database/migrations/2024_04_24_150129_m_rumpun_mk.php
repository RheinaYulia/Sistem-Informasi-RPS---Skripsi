<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MRumpunMk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rumpun_mk', function (Blueprint $table) {
            $table->id('rumpun_mk_id');
            $table->unsignedBigInteger('dosen_id')->index()->nullable();
            $table->unsignedBigInteger('kurikulum_id')->index();
            $table->string('rumpun_mk', 100)->index();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('created_by')->nullable()->index();
            $table->dateTime('updated_at')->nullable();
            $table->integer('updated_by')->nullable()->index();
            $table->dateTime('deleted_at')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();

            $table->foreign('dosen_id')->references('dosen_id')->on('d_dosen');
            $table->foreign('kurikulum_id')->references('kurikulum_id')->on('d_kurikulum');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_rumpun_mk');
    }
}