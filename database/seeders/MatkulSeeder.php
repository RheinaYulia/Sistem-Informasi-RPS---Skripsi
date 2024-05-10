<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_mk')->insert([
            ['mk_id' => 1, 'mk_nama' => 'Etika dan Profesi','mk_jenis' => 'jenis1'],
            ['mk_id' => 2, 'mk_nama' => 'Struktur Data','mk_jenis' => 'jenis2'],
            ['mk_id' => 3, 'mk_nama' => 'Basis Data','mk_jenis' => 'jenis3'],
        ]);
    }
}
