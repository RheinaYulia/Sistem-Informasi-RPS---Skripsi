<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysPustaka extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('d_rps_pustaka', function (Blueprint $table) {
            $table->foreign('pustaka_id')->references('pustaka_id')->on('d_pustaka'); // Tambahkan FK yang baru
        });
        Schema::table('s_user', function (Blueprint $table) {
            $table->foreign('prodi_id')->references('prodi_id')->on('m_prodi'); // Tambahkan FK yang baru
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
