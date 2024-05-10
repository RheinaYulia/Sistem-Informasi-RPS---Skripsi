<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MCplProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_cpl_prodi')->insert([
            ['cpl_prodi_id' => 1, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK1', 'cpl_prodi_kategori' => 'CPKat1', 'cpl_prodi_deskripsi' => 'CPDesk1'],
            ['cpl_prodi_id' => 2, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK1', 'cpl_prodi_kategori' => 'CLKat1', 'cpl_prodi_deskripsi' => 'CLDesk1'],
            ['cpl_prodi_id' => 3, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK2', 'cpl_prodi_kategori' => 'CPKat2', 'cpl_prodi_deskripsi' => 'CPDesk2'],
            ['cpl_prodi_id' => 4, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK2', 'cpl_prodi_kategori' => 'CLKat2', 'cpl_prodi_deskripsi' => 'CLDesk2'],
            ['cpl_prodi_id' => 5, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK3', 'cpl_prodi_kategori' => 'CPKat3', 'cpl_prodi_deskripsi' => 'CPDesk3'],
            ['cpl_prodi_id' => 6, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK3', 'cpl_prodi_kategori' => 'CLKat3', 'cpl_prodi_deskripsi' => 'CLDesk3'],
            ['cpl_prodi_id' => 7, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK4', 'cpl_prodi_kategori' => 'CPKat4', 'cpl_prodi_deskripsi' => 'CPDesk4'],
            ['cpl_prodi_id' => 8, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK4', 'cpl_prodi_kategori' => 'CLKat4', 'cpl_prodi_deskripsi' => 'CLDesk4'],
            ['cpl_prodi_id' => 9, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK5', 'cpl_prodi_kategori' => 'CPKat5', 'cpl_prodi_deskripsi' => 'CPDesk5'],
            ['cpl_prodi_id' => 10, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK5', 'cpl_prodi_kategori' => 'CLKat5', 'cpl_prodi_deskripsi' => 'CLDesk5'],
        ]);
    }
}
