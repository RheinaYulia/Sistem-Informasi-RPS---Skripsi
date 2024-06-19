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
            ['bk_id' => 1, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat1', 'bk_deskripsi' => 'Konsep Tata Kelola Teknologi Informasi'],
            ['bk_id' => 2, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat1', 'bk_deskripsi' => 'Konsep Tata Kelola Teknologi Informasi'],
            ['bk_id' => 3, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat2', 'bk_deskripsi' => 'Elemen dan Tujuan Tata Kelola Teknologi Informasi'],
            ['bk_id' => 4, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat2', 'bk_deskripsi' => 'Kerangka Kerja dan Standard Tata Kelola'],
            ['bk_id' => 5, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat3', 'bk_deskripsi' => 'COBIT and the IT Governance Institute'],
            ['bk_id' => 6, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat3', 'bk_deskripsi' => 'ITIL and IT Service Management Guidance'],
            ['bk_id' => 7, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat4', 'bk_deskripsi' => 'IT Governance Standards : ISO 9001, 27002, and 38500 '],
            ['bk_id' => 8, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat4', 'bk_deskripsi' => 'Memahami dan menetapkan kerangka kerja Tata Kelola Teknologi Informasi'],
            ['bk_id' => 9, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat5', 'bk_deskripsi' => 'Penerapa Framework Tata kelola Teknologi Informasi '],
            ['bk_id' => 10, 'prodi_id' => 1, 'bk_kode' => '-','bk_kategori' => 'BSKat5', 'bk_deskripsi' => 'Memahami UI pada Unity 3D'],
            ['bk_id' => 11, 'prodi_id' => 1, 'bk_kode' => '-','bk_kategori' => 'BSKat6', 'bk_deskripsi' => 'Memahami Core UI'],
            ['bk_id' => 12, 'prodi_id' => 1, 'bk_kode' => '-','bk_kategori' => 'BTKat6', 'bk_deskripsi' => 'Memahami Inventory UI'],
            ['bk_id' => 13, 'prodi_id' => 1, 'bk_kode' => '-','bk_kategori' => 'BTKat7', 'bk_deskripsi' => 'Memahami setting gerak dan animasi karakter player dalam 2D'],
            ['bk_id' => 14, 'prodi_id' => 1, 'bk_kode' => '-','bk_kategori' => 'BSKat7', 'bk_deskripsi' => 'Memahami kamera'],
            ['bk_id' => 15, 'prodi_id' => 1, 'bk_kode' => '-','bk_kategori' => 'BTKat8', 'bk_deskripsi' => 'Memahami pengaturan light dan effect'],
            ['bk_id' => 16, 'prodi_id' => 1, 'bk_kode' => '-','bk_kategori' => 'BSKat8', 'bk_deskripsi' => 'Memahami light dan effect'],
            ['bk_id' => 17, 'prodi_id' => 1, 'bk_kode' => '-','bk_kategori' => 'BTKat9', 'bk_deskripsi' => 'Memahami sound dan animasi game yang digunakan'],
            ['bk_id' => 18, 'prodi_id' => 1, 'bk_kode' => '-','bk_kategori' => 'BSKat9', 'bk_deskripsi' => 'Memahami Controlling 3D'],
            ['bk_id' => 19, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat10', 'bk_deskripsi' => 'Konsep dasar audit sistem informasi'],
            ['bk_id' => 20, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat10', 'bk_deskripsi' => 'Standar dan panduan audit sistem informasi'],
            ['bk_id' => 21, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat11', 'bk_deskripsi' => 'Management control framework'],
            ['bk_id' => 22, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat11', 'bk_deskripsi' => 'Perencanaan dan manajemen audit sistem informasi'],
            ['bk_id' => 23, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat12', 'bk_deskripsi' => 'Pengumpulan dan evaluasi bukti'],
            ['bk_id' => 24, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat12', 'bk_deskripsi' => 'IT evaluation, direct, and monitoring'],
            ['bk_id' => 25, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat13', 'bk_deskripsi' => 'Auditing IT aligning, planning, dan organization'],
            ['bk_id' => 26, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat13', 'bk_deskripsi' => 'Auditing IT build, acquiring, and implementation'],
            ['bk_id' => 27, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat14', 'bk_deskripsi' => 'Auditing IT delivery, service, dan suppor'],
            ['bk_id' => 28, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat14', 'bk_deskripsi' => 'Auditing IT monitoring, evaluation, and assessmen'],
            ['bk_id' => 29, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BTKat15', 'bk_deskripsi' => 'IT Governance'],
            ['bk_id' => 30, 'prodi_id' => 2, 'bk_kode' => '-','bk_kategori' => 'BSKat15', 'bk_deskripsi' => 'Audit IT pada domain EDM, APO, DSS, dan MEA.'],
        ]);
    }
}
