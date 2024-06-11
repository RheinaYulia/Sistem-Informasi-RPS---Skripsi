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
            ['cpl_prodi_id' => 1, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK1', 'cpl_prodi_kategori' => 'CPKat1', 'cpl_prodi_deskripsi' => 'Bertakwa kepada Tuhan Yang Maha Esa, taat hukum, dan disiplin dalam kehidupan bermasyarakat dan bernegara.'],
            ['cpl_prodi_id' => 2, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK1', 'cpl_prodi_kategori' => 'CLKat1', 'cpl_prodi_deskripsi' => 'Menunjukkan sikap profesional dalam bentuk Institusi/Universitas kepatuhan pada etika profesi, kemampuan  bekerjasama dalam tim multidisiplin,  pemahaman tentang pembelajaran sepanjang  hayat, dan respon terhadap isu sosial dan perkembangan teknologi. '],
            ['cpl_prodi_id' => 3, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK2', 'cpl_prodi_kategori' => 'CPKat2', 'cpl_prodi_deskripsi' => 'Memiliki pengetahuan yang memadai terkait cara kerja sistem komputer dan mampu menerapkan/menggunakan berbagai algoritma/metode untuk memecahkan masalah pada suatu organisasi'],
            ['cpl_prodi_id' => 4, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK2', 'cpl_prodi_kategori' => 'CLKat2', 'cpl_prodi_deskripsi' => 'Memiliki kompetensi untuk menganalisis persoalan computing yang kompleks untuk mengidentifikasi solusi pengelolaan proyek teknologi bidang informatika/ilmu komputer dengan mempertimbangkan wawasan perkembangan ilmu transdisiplin'],
            ['cpl_prodi_id' => 5, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK3', 'cpl_prodi_kategori' => 'CPKat3', 'cpl_prodi_deskripsi' => 'Menguasai konsep teoritis bidang pengetahuan Ilmu Komputer/Informatika dalam mendesain dan mensimulasikan aplikasi teknologi multi-platform yang relevan dengan kebutuhan industri dan masyarakat'],
            ['cpl_prodi_id' => 6, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK3', 'cpl_prodi_kategori' => 'CLKat3', 'cpl_prodi_deskripsi' => 'Memiliki kemampuan (pengelolaan) manajerial tim dan kerja sama (team work), manajemen diri, mampu berkomunikasi baik lisan maupun tertulis dengan baik dan mampu melakukan presentasi.'],
            ['cpl_prodi_id' => 7, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK4', 'cpl_prodi_kategori' => 'CPKat4', 'cpl_prodi_deskripsi' => 'Menyusun deskripsi saintifik hasil kajian implikasi pengembangan atau implementasi ilmu pengetahuan teknologi dalam bentuk skripsi atau laporan tugas akhir atau artikel ilmiah. '],
            ['cpl_prodi_id' => 8, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK4', 'cpl_prodi_kategori' => 'CLKat4', 'cpl_prodi_deskripsi' => 'Kemampuan mengimplementasi kebutuhan computing dengan mempertimbangkan berbagai metode/algoritma yang sesuai.'],
            ['cpl_prodi_id' => 9, 'prodi_id' => 1, 'cpl_prodi_kode' => 'CPK5', 'cpl_prodi_kategori' => 'CPKat5', 'cpl_prodi_deskripsi' => 'Kemampuan menganalisis, merancang, membuat dan mengevaluasi user interface dan aplikasi interaktif dengan mempertimbangkan kebutuhan pengguna dan perkembangan ilmu transdisiplin.'],
            ['cpl_prodi_id' => 10, 'prodi_id' => 2, 'cpl_prodi_kode' => 'CLK5', 'cpl_prodi_kategori' => 'CLKat5', 'cpl_prodi_deskripsi' => 'Kemampuan mendesain, mengimplementasi dan mengevaluasi solusi berbasis computing multi-platform yang memenuhi kebutuhan kebutuhan computing pada sebuah organisasi'],
        ]);
    }
}
