<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_prodi')->insert([
            ['prodi_id' => 1, 'nama_prodi' => 'Teknik Informatika'],
            ['prodi_id' => 2, 'nama_prodi' => 'Sistem Informasi Bisnis'],
        ]);
    }
}
