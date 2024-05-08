<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SpInsertOrUpdateRPS extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP procedure IF EXISTS sp_InsertOrUpdateRPS");
        $procedure = "CREATE PROCEDURE sp_InsertOrUpdateRPS (
            IN p_rps_id INT,
            IN p_jenis_media TINYINT,
            IN p_nama_media VARCHAR(50),
            IN p_dosen_id INT
        )
        BEGIN
            -- Declare variables
            DECLARE v_rps_media_id INT;
            DECLARE v_rps_pengampu_id INT;
        
            -- Insert or update d_rps_media table
            INSERT INTO d_rps_media (rps_id, jenis_media, nama_media)
            VALUES (p_rps_id, p_jenis_media, p_nama_media)
            ON DUPLICATE KEY UPDATE jenis_media = VALUES(jenis_media), nama_media = VALUES(nama_media);
        
            -- Get the rps_media_id
            SELECT rps_media_id INTO v_rps_media_id FROM d_rps_media WHERE rps_id = p_rps_id;
        
            -- Insert or update d_rps_pengampu table
            INSERT INTO d_rps_pengampu (rps_id, dosen_id)
            VALUES (p_rps_id, p_dosen_id)
            ON DUPLICATE KEY UPDATE dosen_id = VALUES(dosen_id);
        
            -- Get the rps_pengampu_id
            SELECT rps_pengampu_id INTO v_rps_pengampu_id FROM d_rps_pengampu WHERE rps_id = p_rps_id;
        
            -- Return the rps_media_id and rps_pengampu_id
            SELECT v_rps_media_id AS rps_media_id, v_rps_pengampu_id AS rps_pengampu_id;
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
