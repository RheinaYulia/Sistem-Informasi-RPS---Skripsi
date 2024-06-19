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
            ['cpl_prodi_id' => 1, 'prodi_id' => 2, 'cpl_prodi_kode' => 'S8', 'cpl_prodi_kategori' => 'CPKat1', 'cpl_prodi_deskripsi' => 'Memiliki pengetahuan essai dengan capaian pembelajaran program studi D4 Sistem Inormasi Bisnis.'],
            ['cpl_prodi_id' => 2, 'prodi_id' => 2, 'cpl_prodi_kode' => 'S9', 'cpl_prodi_kategori' => 'CPKat2', 'cpl_prodi_deskripsi' => 'Menunjukkan sikap bertanggungjawab atas pekerjaan di bidang keahliannya secara mandiri.'],
            ['cpl_prodi_id' => 3, 'prodi_id' => 2, 'cpl_prodi_kode' => 'PP2', 'cpl_prodi_kategori' => 'CLKat2', 'cpl_prodi_deskripsi' => 'Menguasai metode pengembangan produk TIK untuk memberikan solusi yang tepat melalui satu atau lebih domain aplikasi.'],
            ['cpl_prodi_id' => 4, 'prodi_id' => 2, 'cpl_prodi_kode' => 'KK1', 'cpl_prodi_kategori' => 'CPKat3', 'cpl_prodi_deskripsi' => 'Mampu mengembaangkan teori dan konsep terhadap Tata Kelola TI dan '],
            ['cpl_prodi_id' => 5, 'prodi_id' => 2, 'cpl_prodi_kode' => 'KU1', 'cpl_prodi_kategori' => 'CLKat3', 'cpl_prodi_deskripsi' => 'Mampu menerapkan pemikian logis, kritis, inovatif, bermutu, dan terukur dalam melakukan pekerjaan yang spesifik di bidang keahliannya serta sesuai dengan standar kompetensi kerja bidang yang bersangkutan.'],
            ['cpl_prodi_id' => 6, 'prodi_id' => 2, 'cpl_prodi_kode' => 'KU2', 'cpl_prodi_kategori' => 'CPKat4', 'cpl_prodi_deskripsi' => 'Mampu menunjukkan kinerja mandiri, bermutu dan terukur. '],
            ['cpl_prodi_id' => 7, 'prodi_id' => 1, 'cpl_prodi_kode' => '-', 'cpl_prodi_kategori' => 'CLKat4', 'cpl_prodi_deskripsi' => 'Mampu memahami penerapan konsep Multimedia'],
            ['cpl_prodi_id' => 8, 'prodi_id' => 1, 'cpl_prodi_kode' => '-', 'cpl_prodi_kategori' => 'CPKat5', 'cpl_prodi_deskripsi' => 'Mampu memahami penerapan konsep Core UI dan Inventory UI'],
            ['cpl_prodi_id' => 9, 'prodi_id' => 1, 'cpl_prodi_kode' => '-', 'cpl_prodi_kategori' => 'CLKat5', 'cpl_prodi_deskripsi' => 'Mampu memahami penerapan konsep Sound, Light dan Effect'],
            ['cpl_prodi_id' => 10, 'prodi_id' => 1, 'cpl_prodi_kode' => '-', 'cpl_prodi_kategori' => 'CPKat6', 'cpl_prodi_deskripsi' => 'Mampu mengimplementasikan animasi game berbasis 2D dan 3D'],
            ['cpl_prodi_id' => 11, 'prodi_id' => 1, 'cpl_prodi_kode' => '-', 'cpl_prodi_kategori' => 'CLKat6', 'cpl_prodi_deskripsi' => 'Mampu membuat game 2D atau 3D'],
            ['cpl_prodi_id' => 12, 'prodi_id' => 2, 'cpl_prodi_kode' => 'S3', 'cpl_prodi_kategori' => 'CPKat7', 'cpl_prodi_deskripsi' => 'Berkontribusi dalam peningkatan mutu kehidupan bermasyarakat, berbangsa, bernegara, dan kemajuan peradaban berdasarkan Pancasila'],
            ['cpl_prodi_id' => 13, 'prodi_id' => 2, 'cpl_prodi_kode' => 'KU7', 'cpl_prodi_kategori' => 'CLKat7', 'cpl_prodi_deskripsi' => 'Mampu melakukan proses evaluasi diri terhadap kelompok kerja yang berada dibawah tanggung jawabnya, dan mampu mengelola pembelajaran secara mandiri '],
            ['cpl_prodi_id' => 14, 'prodi_id' => 2, 'cpl_prodi_kode' => 'KU8 ', 'cpl_prodi_kategori' => 'CPKat8', 'cpl_prodi_deskripsi' => 'Mampu menyelesaikan masalah yang dihadapi secara efektif dan efisien'],
            ['cpl_prodi_id' => 15, 'prodi_id' => 2, 'cpl_prodi_kode' => 'KK8', 'cpl_prodi_kategori' => 'CLKat8', 'cpl_prodi_deskripsi' => 'Memiliki kemampuan merencanakan, menerapkan, memelihara dan meningkatkan sistem informasi organisasi untuk mencapai tujuan dan sasaran organisasi yang strategis baik jangka pendek maupun jangka panjang. '],
        ]);
    }
}
