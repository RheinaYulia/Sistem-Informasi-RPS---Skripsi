<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DCpmkDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_cpmk_detail')->insert([
            ['cpmk_detail_id' => 1, 'cpmk_id' =>1,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu menjelaskan Konsep tata kelola Teknologi informasi'],
            ['cpmk_detail_id' => 2, 'cpmk_id' =>2,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu menjelaskan Pondasi Tata Kelola Teknologi Informasi'],
            ['cpmk_detail_id' => 3, 'cpmk_id' =>3,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu menjelaskan Elemen dan Tujuan Tata Kelola Teknologi Informasi'],
            ['cpmk_detail_id' => 4, 'cpmk_id' =>4,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Menjelaskan COBIT and the IT Governance Institute'],
            ['cpmk_detail_id' => 5, 'cpmk_id' =>5,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Menjelaskan ITIL and IT Service Management Guidance  '],
            ['cpmk_detail_id' => 6, 'cpmk_id' =>6,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu menjelaskan IT Governance Standards : ISO 9001, 27002, dan 38500'],
            ['cpmk_detail_id' => 7, 'cpmk_id' =>7,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu Memahami dan menetapkan kerangka kerja Tata Kelola Teknologi Informasi'],
            ['cpmk_detail_id' => 8, 'cpmk_id' =>8,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Menjelaskan Kerangka Kerja dan Standard Tata Kelola '],
            ['cpmk_detail_id' => 9, 'cpmk_id' =>9,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Project and Review  '],
            ['cpmk_detail_id' => 10, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Memahami beberapa macam tools yang ada di Unity 3D'],
            ['cpmk_detail_id' => 11, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami pembuatan “Hello World” pada Unity'],
            ['cpmk_detail_id' => 12, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami eksekusi ke dalam beberapa build platform.'],
            ['cpmk_detail_id' => 13, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami menu utama pada animasi game'],
            ['cpmk_detail_id' => 14, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami pergerakan karakter player dengan tools yang telah ditentukan.'],
            ['cpmk_detail_id' => 15, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu mengerjakan setiap gerak karakter player '],
            ['cpmk_detail_id' => 16, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu mengimplementasikan pembuatan animasi yang sesuai dengan karakter'],
            ['cpmk_detail_id' => 17, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami pengaturan kamera'],
            ['cpmk_detail_id' => 18, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami modifikasi yang diperlukan light dan effect untuk mengolah animasi game '],
            ['cpmk_detail_id' => 19, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami pengatur langkah-langkah light dan effect yang digunakan dalam animasi game'],
            ['cpmk_detail_id' => 20, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu pengolahan efek yang digunakan didalam animasi game'],
            ['cpmk_detail_id' => 21, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami langkah-langka setiap Light dan Effect pada animasi game'],
            ['cpmk_detail_id' => 22, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami piranti untuk mengolah manipulation sound'],
            ['cpmk_detail_id' => 23, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami pengaturan suara didalam animasi game yang dibuat'],
            ['cpmk_detail_id' => 24, 'cpmk_id' =>10,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Mampu memahami, dan menganalisa animasi game dengan 3D serta memahami hasil animasi game '],
            ['cpmk_detail_id' => 25, 'cpmk_id' =>11,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Konsep dasar audit sistem informasi'],
            ['cpmk_detail_id' => 26, 'cpmk_id' =>12,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Standar dan panduan audit sistem informasi'],
            ['cpmk_detail_id' => 27, 'cpmk_id' =>13,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Management control framework '],
            ['cpmk_detail_id' => 28, 'cpmk_id' =>14,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Perencanaan dan manajemen audit sistem informasi '],
            ['cpmk_detail_id' => 29, 'cpmk_id' =>15,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Pengumpulan dan evaluasi bukti'],
            ['cpmk_detail_id' => 30, 'cpmk_id' =>16,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'IT evaluation, direct, and monitoring'],
            ['cpmk_detail_id' => 31, 'cpmk_id' =>17,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Auditing IT aligning, planning, dan organization'],
            ['cpmk_detail_id' => 32, 'cpmk_id' =>18,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Auditing IT build, acquiring, and implementation '],
            ['cpmk_detail_id' => 33, 'cpmk_id' =>19,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Auditing IT delivery, service, dan support. '],
            ['cpmk_detail_id' => 34, 'cpmk_id' =>20,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'IT governance'],
            ['cpmk_detail_id' => 35, 'cpmk_id' =>21,'sub_cpmk_kode'=>'-', 'uraian_sub_cpmk' => 'Audit IT pada domain EDM, APO, DSS, dan MEA'],
        ]);
    }
}
