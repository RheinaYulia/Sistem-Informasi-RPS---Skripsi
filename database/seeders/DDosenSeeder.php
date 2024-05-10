<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_dosen')->insert([
            ['dosen_id' => 1, 'nama_dosen' => 'Coba'],
            ['dosen_id' => 2, 'nama_dosen' => 'Tes'],
        ]);
    }
}
