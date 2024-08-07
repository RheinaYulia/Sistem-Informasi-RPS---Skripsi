<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SpGetRpsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
        DROP procedure IF EXISTS sp_get_rps_data");
        $procedure = 
        "CREATE PROCEDURE sp_get_rps_data (IN p_rps_id INT) 
        BEGIN 
            SELECT m_rps.*, 
                   d_rps_media.jenis_media, 
                   d_rps_media.nama_media,
                   d_dosen.dosen_id,
                   d_dosen.nama_dosen
            FROM 
                m_rps 
            LEFT JOIN 
                d_rps_media ON m_rps.rps_id = d_rps_media.rps_id 
            LEFT JOIN 
                d_rps_pengampu ON m_rps.rps_id = d_rps_pengampu.rps_id 
            LEFT JOIN 
                d_dosen ON d_rps_pengampu.dosen_id = d_dosen.dosen_id
            WHERE 
                m_rps.rps_id = p_rps_id;
        END";
        

DB::unprepared($procedure);
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
