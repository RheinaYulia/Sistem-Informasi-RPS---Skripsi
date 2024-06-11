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
            -- IN p_rps_bab INT,
            -- IN p_sub_cpmk VARCHAR(500),
            -- IN p_materi TEXT,
            -- IN p_estimasi_waktu VARCHAR(50),
            -- IN p_pengalaman_belajar TEXT,
            -- IN p_indikator_penilaian TEXT,
            -- IN p_bobot_penilaian DECIMAL(8,2)
            -- IN p_bab_id INT,
            -- IN p_bentuk_pembelajaran VARCHAR(255),
            -- IN p_metode_pembelajaran VARCHAR(255)
        )
        BEGIN
            -- Declare variables
            DECLARE v_rps_media_id INT;
            DECLARE v_rps_pengampu_id INT;
            -- DECLARE v_bab_id INT;
            -- DECLARE v_rps_metode_id INT;
        
            -- -- Insert or update d_rps_media table
            -- INSERT INTO d_rps_media (rps_id, jenis_media, nama_media)
            -- VALUES (p_rps_id, p_jenis_media, p_nama_media)
            -- ON DUPLICATE KEY UPDATE jenis_media = VALUES(jenis_media), nama_media = VALUES(nama_media);

            -- Insert or update d_rps_media table
IF EXISTS(SELECT 1 FROM d_rps_media WHERE rps_id = p_rps_id) THEN
    UPDATE d_rps_media
    SET jenis_media = p_jenis_media, nama_media = p_nama_media
    WHERE rps_id = p_rps_id;
ELSE
    INSERT INTO d_rps_media (rps_id, jenis_media, nama_media)
    VALUES (p_rps_id, p_jenis_media, p_nama_media);
END IF;

        
            -- Get the rps_media_id
            SELECT rps_media_id INTO v_rps_media_id FROM d_rps_media WHERE rps_id = p_rps_id;
        
            -- -- Insert or update d_rps_pengampu table
            -- INSERT INTO d_rps_pengampu (rps_id, dosen_id)
            -- VALUES (p_rps_id, p_dosen_id)
            -- ON DUPLICATE KEY UPDATE dosen_id = VALUES(dosen_id);

            -- Insert or update d_rps_media table
IF EXISTS(SELECT 1 FROM d_rps_pengampu WHERE rps_id = p_rps_id) THEN
    UPDATE d_rps_pengampu
    SET dosen_id = p_dosen_id
    WHERE rps_id = p_rps_id;
ELSE
    INSERT INTO d_rps_pengampu (rps_id, dosen_id)
    VALUES (p_rps_id, p_dosen_id);
END IF;

        
            -- Get the rps_pengampu_id
            SELECT rps_pengampu_id INTO v_rps_pengampu_id FROM d_rps_pengampu WHERE rps_id = p_rps_id;


            -- Insert or update d_rps_media table
-- IF EXISTS(SELECT 1 FROM d_rps_bab WHERE rps_id = p_rps_id) THEN
--     UPDATE d_rps_bab
--     SET rps_bab = p_rps_bab, sub_cpmk = p_sub_cpmk, materi = p_materi, estimasi_waktu = p_estimasi_waktu,pengalaman_belajar = p_pengalaman_belajar, indikator_penilaian = p_indikator_penilaian,
--     bobot_penilaian = p_bobot_penilaian
--     WHERE rps_id = p_rps_id;
-- ELSE
--     INSERT INTO d_rps_bab (rps_id, rps_bab, sub_cpmk, materi, estimasi_waktu, pengalaman_belajar, indikator_penilaian, bobot_penilaian)
--     VALUES (p_rps_id, p_rps_bab, p_sub_cpmk, p_materi, p_estimasi_waktu, p_pengalaman_belajar, p_indikator_penilaian, p_bobot_penilaian);
-- END IF;

        
--             -- Get the rps_pengampu_id
--             SELECT bab_id INTO v_bab_id FROM d_rps_bab WHERE rps_id = p_rps_id;


--         -- Insert or update d_rps_media table
-- IF EXISTS(SELECT 1 FROM d_rps_metode WHERE bab_id = p_bab_id) THEN
--     UPDATE d_rps_metode
--     SET bentuk_pembelajaran = p_bentuk_pembelajaran, metode_pembelajaran = p_metode_pembelajaran
--     WHERE bab_id = p_bab_id;
-- ELSE
--     INSERT INTO d_rps_metode (bab_id, bentuk_pembelajaran, metode_pembelajaran)
--     VALUES (p_bab_id, p_bentuk_pembelajaran, p_metode_pembelajaran);
-- END IF;

        
--             -- Get the rps_pengampu_id
--             SELECT rps_metode_id INTO v_rps_metode_id FROM d_rps_metode WHERE bab_id = p_bab_id;

        
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

//Triger user dan dosen

// CREATE TRIGGER update_is_developer
// AFTER UPDATE ON d_dosen
// FOR EACH ROW
// BEGIN
//     IF NEW.is_developer != OLD.is_developer THEN
//         UPDATE s_user
//         SET is_developer = NEW.is_developer
//         WHERE user_id = NEW.user_id;
//     END IF;
// END;

