<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DKurikulumMKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_kurikulum_mk')->insert([
            ['kurikulum_mk_id' => 1, 'kurikulum_id' => 1, 'rumpun_mk_id' => 1, 'mk_id' => 1, 'prodi_id'=> 1,'kode_mk' => 'MK1','sks' => 3,'semester' => 5,'kelompok_mk' => 'kelompok1'],
            ['kurikulum_mk_id' => 2, 'kurikulum_id' => 2, 'rumpun_mk_id' => 2, 'mk_id' => 2, 'prodi_id'=> 2,'kode_mk' => 'MK1','sks' => 3,'semester' => 5,'kelompok_mk' => 'kelompok1'],
        ]);
    }
}
