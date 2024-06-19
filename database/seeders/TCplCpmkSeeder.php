<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TCplCpmkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_cpl_cpmk')->insert([
            ['cpl_cpmk_id' => 1, 'cpl_prodi_id' => 1, 'cpmk_id' => 1],
            ['cpl_cpmk_id' => 2, 'cpl_prodi_id' => 1, 'cpmk_id' => 2],
            ['cpl_cpmk_id' => 3, 'cpl_prodi_id' => 2, 'cpmk_id' => 3],
            ['cpl_cpmk_id' => 4, 'cpl_prodi_id' => 3, 'cpmk_id' => 4],
            ['cpl_cpmk_id' => 5, 'cpl_prodi_id' => 4, 'cpmk_id' => 5],
            ['cpl_cpmk_id' => 6, 'cpl_prodi_id' => 5, 'cpmk_id' => 6],
            ['cpl_cpmk_id' => 7, 'cpl_prodi_id' => 5, 'cpmk_id' => 7],
            ['cpl_cpmk_id' => 8, 'cpl_prodi_id' => 6, 'cpmk_id' => 8],
            ['cpl_cpmk_id' => 9, 'cpl_prodi_id' => 6, 'cpmk_id' => 9],
            ['cpl_cpmk_id' => 10, 'cpl_prodi_id' => 7, 'cpmk_id' => 10],
            ['cpl_cpmk_id' => 11, 'cpl_prodi_id' => 12, 'cpmk_id' => 11],
            ['cpl_cpmk_id' => 12, 'cpl_prodi_id' => 12, 'cpmk_id' => 12],
            ['cpl_cpmk_id' => 13, 'cpl_prodi_id' => 12, 'cpmk_id' => 13],
            ['cpl_cpmk_id' => 14, 'cpl_prodi_id' => 13, 'cpmk_id' => 14],
            ['cpl_cpmk_id' => 15, 'cpl_prodi_id' => 13, 'cpmk_id' => 15],
            ['cpl_cpmk_id' => 16, 'cpl_prodi_id' => 13, 'cpmk_id' => 16],
            ['cpl_cpmk_id' => 17, 'cpl_prodi_id' => 14, 'cpmk_id' => 17],
            ['cpl_cpmk_id' => 18, 'cpl_prodi_id' => 14, 'cpmk_id' => 18],
            ['cpl_cpmk_id' => 19, 'cpl_prodi_id' => 14, 'cpmk_id' => 19],
            ['cpl_cpmk_id' => 20, 'cpl_prodi_id' => 15, 'cpmk_id' => 20],
            ['cpl_cpmk_id' => 21, 'cpl_prodi_id' => 15, 'cpmk_id' => 21],
            ['cpl_cpmk_id' => 22, 'cpl_prodi_id' => 15, 'cpmk_id' => 22],
        ]);
    }
}
