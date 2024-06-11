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
            ['cpmk_id' => 1, 'mk_id' => 1,'cpmk_kode' =>'CpM1', 'cpmk_deskripsi' => 'Mampu menginternalisasi nilai-nilai ketaqwaan kepada Tuhan Yang Maha Esa '],
            ['cpmk_id' => 2, 'mk_id' => 2,'cpmk_kode' =>'CpK1', 'cpmk_deskripsi' => 'Mampu menjalankan kehidupan sosial masyarakat yang berdasarkan aturan dan norma hukum yang berlaku.'],
            ['cpmk_id' => 3, 'mk_id' => 1,'cpmk_kode' =>'CpM2', 'cpmk_deskripsi' => 'Mampu menerapkan kedisiplinan dalam kehidupan bermasyarakat dan bernegara.'],
            ['cpmk_id' => 4, 'mk_id' => 2,'cpmk_kode' =>'CpK2', 'cpmk_deskripsi' => 'Mampu memahami cara kerja sistem komputer'],
            ['cpmk_id' => 5, 'mk_id' => 1,'cpmk_kode' =>'CpM3', 'cpmk_deskripsi' => 'Mampu menerapkan/menggunakan berbagai metode/algoritma dalam memecahkan masalah pada suatu organisasi'],
            ['cpmk_id' => 6, 'mk_id' => 2,'cpmk_kode' =>'CpK3', 'cpmk_deskripsi' => 'Mampu menguasai konsep teoritis bidang pengetahuan Ilmu Komputer/Informatika dalam mendesain aplikasi teknologi multi-platform yang relevan dengan kebutuhan industri dan masyarakat'],
            ['cpmk_id' => 7, 'mk_id' => 1,'cpmk_kode' =>'CpM4', 'cpmk_deskripsi' => 'Mampu menguasai konsep teoritis bidang pengetahuan Ilmu Komputer/Informatika dalam mensimulasikan aplikasi teknologi multi-platform'],
            ['cpmk_id' => 8, 'mk_id' => 2,'cpmk_kode' =>'CpK4', 'cpmk_deskripsi' => 'Mampu mengelola tim, komunikasi dan berkolaborasi dalam proyek teknologi informasi'],
            ['cpmk_id' => 9, 'mk_id' => 1,'cpmk_kode' =>'CpM5', 'cpmk_deskripsi' => 'Mampu mengelola diri sendir'],
            ['cpmk_id' => 10, 'mk_id' => 2,'cpmk_kode' =>'CpK5', 'cpmk_deskripsi' => 'Mampu menyajikan gagasan secara lisan dan tertulis'],
        ]);
    }
}
