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
            ['kurikulum_mk_id' => 1, 'kurikulum_id' => 1, 'rumpun_mk_id' => 1, 'mk_id' => 1, 'prodi_id'=> 2,'kode_mk' => 'SIB208002','sks' => 3,'semester' => 5,'kelompok_mk' => 'kelompok1','jumlah_jam' => 4],
            ['kurikulum_mk_id' => 2, 'kurikulum_id' => 2, 'rumpun_mk_id' => 2, 'mk_id' => 2, 'prodi_id'=> 1,'kode_mk' => 'RTI186004','sks' => 2,'semester' => 4,'kelompok_mk' => 'kelompok1','jumlah_jam' => 4],
            ['kurikulum_mk_id' => 3, 'kurikulum_id' => 2, 'rumpun_mk_id' => 3, 'mk_id' => 3, 'prodi_id'=> 2,'kode_mk' => 'SIB207104','sks' => 3,'semester' => 5,'kelompok_mk' => 'kelompok1','jumlah_jam' => 4],
        ]);
    }
}
