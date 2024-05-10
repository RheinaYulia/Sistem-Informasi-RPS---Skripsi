<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DCpmkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_cpmk')->insert([
            ['cpmk_id' => 1, 'mk_id' => 1,'cpmk_kode' =>'CpM1', 'cpmk_deskripsi' => 'CpMDesk1'],
            ['cpmk_id' => 2, 'mk_id' => 2,'cpmk_kode' =>'CpK1', 'cpmk_deskripsi' => 'CpKDesk1'],
            ['cpmk_id' => 3, 'mk_id' => 1,'cpmk_kode' =>'CpM2', 'cpmk_deskripsi' => 'CpMDesk2'],
            ['cpmk_id' => 4, 'mk_id' => 2,'cpmk_kode' =>'CpK2', 'cpmk_deskripsi' => 'CpKDesk2'],
            ['cpmk_id' => 5, 'mk_id' => 1,'cpmk_kode' =>'CpM3', 'cpmk_deskripsi' => 'CpMDesk3'],
            ['cpmk_id' => 6, 'mk_id' => 2,'cpmk_kode' =>'CpK3', 'cpmk_deskripsi' => 'CpKDesk3'],
            ['cpmk_id' => 7, 'mk_id' => 1,'cpmk_kode' =>'CpM4', 'cpmk_deskripsi' => 'CpMDesk4'],
            ['cpmk_id' => 8, 'mk_id' => 2,'cpmk_kode' =>'CpK4', 'cpmk_deskripsi' => 'CpKDesk4'],
            ['cpmk_id' => 9, 'mk_id' => 1,'cpmk_kode' =>'CpM5', 'cpmk_deskripsi' => 'CpMDesk5'],
            ['cpmk_id' => 10, 'mk_id' => 2,'cpmk_kode' =>'CpK5', 'cpmk_deskripsi' => 'CpKDesk5'],
        ]);
    }
}
