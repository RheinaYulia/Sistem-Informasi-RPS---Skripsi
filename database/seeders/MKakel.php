<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MKakel extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_kakel')->insert([
            ['m_kakel_id' => 1, 'Jabatan' => 'KaPokJar MK Penunjang Prodi D4 Teknik Informatika'],
            ['m_kakel_id' => 2, 'Jabatan' => 'KaPokJar MK Informatika Inti Prodi D4 Teknik Informatika'],
            ['m_kakel_id' => 3, 'Jabatan' => 'KaPokJar MK Informatika Keahlian Prodi D4 Teknik Informatika'],
            ['m_kakel_id' => 4, 'Jabatan' => 'KaPokJar MK Informatika Lanjut Prodi D4 Teknik Informatika'],
            ['m_kakel_id' => 5, 'Jabatan' => 'KaPokJar MK Dasar Program Prodi D4 Teknik Informatika'],
            ['m_kakel_id' => 6, 'Jabatan' => 'KaPokJar MK Dasar Program Prodi D4 Sistem Informasi Bisnis'],
            ['m_kakel_id' => 7, 'Jabatan' => 'KaPokJar MK Informatika Keahlian Prodi D4 Sistem Informasi Manajemen'],
            ['m_kakel_id' => 8, 'Jabatan' => 'KaPokJar MK Informatika Inti Prodi D4 Sistem Informasi'],
            ['m_kakel_id' => 9, 'Jabatan' => 'KaPokJar MK Penunjang Prodi D4 Sistem Informasi'],
        ]);
    }
}
