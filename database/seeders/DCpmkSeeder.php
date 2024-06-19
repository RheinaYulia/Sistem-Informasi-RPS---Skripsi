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
        ]);
    }
}
