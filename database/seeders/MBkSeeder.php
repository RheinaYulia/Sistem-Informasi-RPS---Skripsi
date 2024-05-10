<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MBkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_bahan_kajian')->insert([
            ['bk_id' => 1, 'prodi_id' => 1, 'bk_kode' => 'BT1','bk_kategori' => 'BTKat1', 'bk_deskripsi' => 'BTDesk1'],
            ['bk_id' => 2, 'prodi_id' => 2, 'bk_kode' => 'BS1','bk_kategori' => 'BSKat1', 'bk_deskripsi' => 'BSDesk1'],
            ['bk_id' => 3, 'prodi_id' => 1, 'bk_kode' => 'BT2','bk_kategori' => 'BTKat2', 'bk_deskripsi' => 'BTDesk2'],
            ['bk_id' => 4, 'prodi_id' => 2, 'bk_kode' => 'BS2','bk_kategori' => 'BSKat2', 'bk_deskripsi' => 'BSDesk2'],
            ['bk_id' => 5, 'prodi_id' => 1, 'bk_kode' => 'BT3','bk_kategori' => 'BTKat3', 'bk_deskripsi' => 'BTDesk3'],
            ['bk_id' => 6, 'prodi_id' => 2, 'bk_kode' => 'BS3','bk_kategori' => 'BSKat3', 'bk_deskripsi' => 'BSDesk3'],
            ['bk_id' => 7, 'prodi_id' => 1, 'bk_kode' => 'BT4','bk_kategori' => 'BTKat4', 'bk_deskripsi' => 'BTDesk4'],
            ['bk_id' => 8, 'prodi_id' => 2, 'bk_kode' => 'BS4','bk_kategori' => 'BSKat4', 'bk_deskripsi' => 'BSDesk4'],
            ['bk_id' => 9, 'prodi_id' => 1, 'bk_kode' => 'BT5','bk_kategori' => 'BTKat5', 'bk_deskripsi' => 'BTDesk5'],
            ['bk_id' => 10, 'prodi_id' => 2, 'bk_kode' => 'BS5','bk_kategori' => 'BSKat5', 'bk_deskripsi' => 'BSDesk5'],
        ]);
    }
}
