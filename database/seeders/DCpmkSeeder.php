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
            ['cpmk_id' => 1, 'mk_id' => 1, 'cpmk_deskripsi' => 'Memahami konsep tata kelola Teknologi informasi  '],
            ['cpmk_id' => 2, 'mk_id' => 1, 'cpmk_deskripsi' => 'Memahami Pondasi Tata Kelola Teknologi Informasi '],
            ['cpmk_id' => 3, 'mk_id' => 1, 'cpmk_deskripsi' => 'Memahami Elemen dan Tujuan Tata Kelola Teknologi Informasi'],
            ['cpmk_id' => 4, 'mk_id' => 1,'cpmk_deskripsi' => 'Memahami Kerangka Kerja dan Standard Tata Kelola'],
            ['cpmk_id' => 5, 'mk_id' => 1,'cpmk_deskripsi' => 'Memahami COBIT and the IT Governance Institute'],
            ['cpmk_id' => 6, 'mk_id' => 1, 'cpmk_deskripsi' => 'Memahami ITIL and IT Service Management Guidance'],
            ['cpmk_id' => 7, 'mk_id' => 1, 'cpmk_deskripsi' => 'Memahami IT Governance Standards : ISO 9001, 27002, and 38500 '],
            ['cpmk_id' => 8, 'mk_id' => 1, 'cpmk_deskripsi' => 'Memahami dan menetapkan kerangka kerja Tata Kelola Teknologi Informasi'],
            ['cpmk_id' => 9, 'mk_id' => 1, 'cpmk_deskripsi' => 'Mampu menerapkan penggunaan Framework'],
            ['cpmk_id' => 10, 'mk_id' => 2, 'cpmk_deskripsi' => 'Mahasiswa mampu memahami dan mengetahui serta mengimplementasikan penerapan konsep-konsep multimedia dalam proses pengembangan game 2D atau 3D.'],
            ['cpmk_id' => 11, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami dan mampu menjelaskan konsep dasar audit sistem informasi'],
            ['cpmk_id' => 12, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami standar dan panduan audit sistem informasi: ISACA IS audit standards and guidelines, IIA standards, COSO, BS7799, dan ISO 17799'],
            ['cpmk_id' => 13, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami komponen pada management control framework dan application control framework'],
            ['cpmk_id' => 14, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami perencanaan dan manajemen audit sistem informasi'],
            ['cpmk_id' => 15, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami proses pengumpulan dan evaluasi bukti'],
            ['cpmk_id' => 16, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami dan mampu menerapkan auditing IT evaluation, direct, dan monitoring'],
            ['cpmk_id' => 17, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami aspek-aspek pada auditing IT aligning planning, dan organization'],
            ['cpmk_id' => 18, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami aspek-aspek pada auditing IT build, acquiring, dan implementation'],
            ['cpmk_id' => 19, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami aspek-aspek pada auditing IT delivery, service, dan support'],
            ['cpmk_id' => 20, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami aspek-aspek pada auditing IT monitoring, evaluation, dan assessment'],
            ['cpmk_id' => 21, 'mk_id' => 3, 'cpmk_deskripsi' => 'Menerapkan metode dan langkah-langkah audit sistem informasi'],
            ['cpmk_id' => 22, 'mk_id' => 3, 'cpmk_deskripsi' => 'Memahami dan mampu menerapkan audit planning, control, and implementation'],
            // ['cpmk_id' => 23, 'mk_id' => 4, 'cpmk_deskripsi' => 'Memahami dan mampu menerapkan audit delivery, service, and support'],
            ['cpmk_id' => 23, 'mk_id' => 4, 'cpmk_deskripsi' => 'Memahami konsep dasar ajaran agama'],
            ['cpmk_id' => 24, 'mk_id' => 5, 'cpmk_deskripsi' => 'Mampu menguasai penggunaan bahasa Indonesia secara baik dan benar'],
            ['cpmk_id' => 25, 'mk_id' => 6, 'cpmk_deskripsi' => 'Menguasai dasar-dasar bahasa Inggris untuk komunikasi sehari-hari'],
            ['cpmk_id' => 26, 'mk_id' => 7, 'cpmk_deskripsi' => 'Memahami konsep teknologi informasi'],
            ['cpmk_id' => 27, 'mk_id' => 8, 'cpmk_deskripsi' => 'Menguasai keterampilan berpikir kritis dan pemecahan masalah'],
            ['cpmk_id' => 28, 'mk_id' => 9, 'cpmk_deskripsi' => 'Memahami dasar-dasar akuntansi, manajemen, dan bisnis'],
            ['cpmk_id' => 29, 'mk_id' => 10, 'cpmk_deskripsi' => 'Menguasai konsep matematika dasar'],
            ['cpmk_id' => 30, 'mk_id' => 11, 'cpmk_deskripsi' => 'Menguasai dasar-dasar pemrograman'],
            ['cpmk_id' => 31, 'mk_id' => 12, 'cpmk_deskripsi' => 'Mampu mempraktikkan dasar-dasar pemrograman'],
            ['cpmk_id' => 32, 'mk_id' => 13, 'cpmk_deskripsi' => 'Memahami konsep kewarganegaraan'],
            ['cpmk_id' => 33, 'mk_id' => 14, 'cpmk_deskripsi' => 'Menguasai analisa proses bisnis'],
            ['cpmk_id' => 34, 'mk_id' => 15, 'cpmk_deskripsi' => 'Mampu mempraktikkan analisa proses bisnis'],
            ['cpmk_id' => 35, 'mk_id' => 16, 'cpmk_deskripsi' => 'Memahami pengenalan sistem informasi'],
            ['cpmk_id' => 36, 'mk_id' => 17, 'cpmk_deskripsi' => 'Menguasai algoritma dan struktur data'],
            ['cpmk_id' => 37, 'mk_id' => 18, 'cpmk_deskripsi' => 'Mampu mempraktikkan algoritma dan struktur data'],
            ['cpmk_id' => 38, 'mk_id' => 19, 'cpmk_deskripsi' => 'Menguasai konsep basis data'],
            ['cpmk_id' => 39, 'mk_id' => 20, 'cpmk_deskripsi' => 'Mampu mempraktikkan basis data'],
            ['cpmk_id' => 40, 'mk_id' => 21, 'cpmk_deskripsi' => 'Menguasai konsep matematika lanjutan'],
            ['cpmk_id' => 41, 'mk_id' => 22, 'cpmk_deskripsi' => 'Memahami konsep sistem operasi'],
            ['cpmk_id' => 42, 'mk_id' => 23, 'cpmk_deskripsi' => 'Menguasai konsep jaringan komputer'],
            ['cpmk_id' => 43, 'mk_id' => 24, 'cpmk_deskripsi' => 'Mampu mempraktikkan jaringan komputer'],
            ['cpmk_id' => 44, 'mk_id' => 25, 'cpmk_deskripsi' => 'Memahami rekayasa perangkat lunak'],
            ['cpmk_id' => 45, 'mk_id' => 26, 'cpmk_deskripsi' => 'Menguasai pemrograman berbasis objek'],
            ['cpmk_id' => 46, 'mk_id' => 27, 'cpmk_deskripsi' => 'Mampu mempraktikkan pemrograman berbasis objek'],
            ['cpmk_id' => 47, 'mk_id' => 28, 'cpmk_deskripsi' => 'Menguasai konsep basis data lanjutan'],
            ['cpmk_id' => 48, 'mk_id' => 29, 'cpmk_deskripsi' => 'Mampu mempraktikkan basis data lanjutan'],
            ['cpmk_id' => 49, 'mk_id' => 30, 'cpmk_deskripsi' => 'Menguasai pemrograman web'],
            ['cpmk_id' => 50, 'mk_id' => 31, 'cpmk_deskripsi' => 'Memahami konsep Pancasila'],
            ['cpmk_id' => 51, 'mk_id' => 32, 'cpmk_deskripsi' => 'Menguasai konsep statistika'],
            ['cpmk_id' => 52, 'mk_id' => 33, 'cpmk_deskripsi' => 'Menguasai bahasa Inggris lanjutan'],
            ['cpmk_id' => 53, 'mk_id' => 34, 'cpmk_deskripsi' => 'Mampu mempraktikkan konsep workshop'],
            ['cpmk_id' => 54, 'mk_id' => 35, 'cpmk_deskripsi' => 'Menguasai konsep data warehouse'],
            ['cpmk_id' => 55, 'mk_id' => 36, 'cpmk_deskripsi' => 'Menguasai konsep data mining'],
            ['cpmk_id' => 56, 'mk_id' => 37, 'cpmk_deskripsi' => 'Memahami analisis dan perancangan sistem informasi'],
            ['cpmk_id' => 57, 'mk_id' => 38, 'cpmk_deskripsi' => 'Menguasai pemrograman web lanjutan'],
            ['cpmk_id' => 58, 'mk_id' => 39, 'cpmk_deskripsi' => 'Memahami metodologi penelitian'],
            ['cpmk_id' => 59, 'mk_id' => 40, 'cpmk_deskripsi' => 'Memahami konsep manajemen rantai pasok'],
            ['cpmk_id' => 60, 'mk_id' => 41, 'cpmk_deskripsi' => 'Memahami perencanaan sumber daya'],
            ['cpmk_id' => 61, 'mk_id' => 42, 'cpmk_deskripsi' => 'Menguasai konsep kecerdasan bisnis'],
            ['cpmk_id' => 62, 'mk_id' => 43, 'cpmk_deskripsi' => 'Memahami penjaminan mutu perangkat lunak'],
            ['cpmk_id' => 63, 'mk_id' => 44, 'cpmk_deskripsi' => 'Menguasai pemrograman mobile'],
            ['cpmk_id' => 64, 'mk_id' => 45, 'cpmk_deskripsi' => 'Memahami manajemen proyek sistem informasi'],
            ['cpmk_id' => 65, 'mk_id' => 46, 'cpmk_deskripsi' => 'Memahami keselamatan dan kesehatan kerja'],
            ['cpmk_id' => 66, 'mk_id' => 47, 'cpmk_deskripsi' => 'Menguasai manajemen jaringan komputer'],
            ['cpmk_id' => 67, 'mk_id' => 48, 'cpmk_deskripsi' => 'Memahami pengembangan karir'],
            ['cpmk_id' => 68, 'mk_id' => 49, 'cpmk_deskripsi' => 'Menguasai etika profesi'],
            ['cpmk_id' => 69, 'mk_id' => 50, 'cpmk_deskripsi' => 'Mampu mempraktikkan proyek sistem informasi'],
            ['cpmk_id' => 70, 'mk_id' => 51, 'cpmk_deskripsi' => 'Menguasai pemasaran digital'],
            ['cpmk_id' => 71, 'mk_id' => 52, 'cpmk_deskripsi' => 'Menguasai manajemen hubungan pelanggan'],
            ['cpmk_id' => 72, 'mk_id' => 53, 'cpmk_deskripsi' => 'Menguasai konsep big data'],
            ['cpmk_id' => 73, 'mk_id' => 54, 'cpmk_deskripsi' => 'Mampu mempraktikkan kewirausahaan'],
            ['cpmk_id' => 74, 'mk_id' => 55, 'cpmk_deskripsi' => 'Menguasai studi kelayakan rencana bisnis'],
            ['cpmk_id' => 75, 'mk_id' => 56, 'cpmk_deskripsi' => 'Menguasai konsep produk bisnis'],
            ['cpmk_id' => 76, 'mk_id' => 57, 'cpmk_deskripsi' => 'Menguasai manajemen bisnis'],
            ['cpmk_id' => 77, 'mk_id' => 58, 'cpmk_deskripsi' => 'Menguasai pemasaran bisnis'],
            ['cpmk_id' => 78, 'mk_id' => 59, 'cpmk_deskripsi' => 'Mampu mempraktikkan proyek capstone'],
            ['cpmk_id' => 79, 'mk_id' => 60, 'cpmk_deskripsi' => 'Menguasai soft skill/kreativitas dan inovasi TI'],
            ['cpmk_id' => 80, 'mk_id' => 61, 'cpmk_deskripsi' => 'Menguasai rekayasa teknologi informasi'],
            ['cpmk_id' => 81, 'mk_id' => 62, 'cpmk_deskripsi' => 'Mampu mengidentifikasi kegiatan MBKM']
        ]);
    }
}
