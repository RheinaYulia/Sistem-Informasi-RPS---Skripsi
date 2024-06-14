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
            ['cpmk_detail_id' => 1, 'cpmk_id' =>1,'sub_cpmk_kode'=>'Sub-CPMK0111', 'uraian_sub_cpmk' => 'Kemampuan untuk bertingkah laku menghargai nilai-nilai kemanusiaan dalam melakukan kegiatannya berdasarkan agama, moral, dan etika.'],
            ['cpmk_detail_id' => 2, 'cpmk_id' =>1,'sub_cpmk_kode'=>'Sub-CPMK0112', 'uraian_sub_cpmk' => 'Kemampuan menjalankan kehidupan sosial masyarakat'],
            ['cpmk_detail_id' => 3, 'cpmk_id' =>2,'sub_cpmk_kode'=>'Sub-CPMK0113', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 4, 'cpmk_id' =>2,'sub_cpmk_kode'=>'Sub-CPMK0114', 'uraian_sub_cpmk' => 'Kemampuan menjalankan aturan dan norma hukum'],
            ['cpmk_detail_id' => 5, 'cpmk_id' =>3,'sub_cpmk_kode'=>'Sub-CPMK0115', 'uraian_sub_cpmk' => 'Kemampuan memahami kehidupan bermasyarakat dan bernegara'],
            ['cpmk_detail_id' => 6, 'cpmk_id' =>3,'sub_cpmk_kode'=>'Sub-CPMK0116', 'uraian_sub_cpmk' => 'Kemampuan menerapkan hukum dan kebijakan bidang TIK'],
            ['cpmk_detail_id' => 7, 'cpmk_id' =>4,'sub_cpmk_kode'=>'Sub-CPMK0117', 'uraian_sub_cpmk' => 'Kemampuan mengelola tim, komunikasi dan kolaborasi dalam manajemen proyek perangkat lunak'],
            ['cpmk_detail_id' => 8, 'cpmk_id' =>4,'sub_cpmk_kode'=>'Sub-CPMK0118', 'uraian_sub_cpmk' => 'Kemampuan mengelola diri dalam manajemen proyek perangkat lunak'],
            ['cpmk_detail_id' => 9, 'cpmk_id' =>5,'sub_cpmk_kode'=>'Sub-CPMK0119', 'uraian_sub_cpmk' => 'emampuan menyajikan gagasan proyek perangkat lunak secara lisan dan tertulis'],
            ['cpmk_detail_id' => 10, 'cpmk_id' =>5,'sub_cpmk_kode'=>'Sub-CPMK0120', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 11, 'cpmk_id' =>6,'sub_cpmk_kode'=>'Sub-CPMK0121', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 12, 'cpmk_id' =>6,'sub_cpmk_kode'=>'Sub-CPMK0122', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 13, 'cpmk_id' =>7,'sub_cpmk_kode'=>'Sub-CPMK0123', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 14, 'cpmk_id' =>7,'sub_cpmk_kode'=>'Sub-CPMK0124', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 15, 'cpmk_id' =>8,'sub_cpmk_kode'=>'Sub-CPMK0125', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 16, 'cpmk_id' =>8,'sub_cpmk_kode'=>'Sub-CPMK0126', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 17, 'cpmk_id' =>9,'sub_cpmk_kode'=>'Sub-CPMK0127', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 18, 'cpmk_id' =>9,'sub_cpmk_kode'=>'Sub-CPMK0128', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 19, 'cpmk_id' =>10,'sub_cpmk_kode'=>'Sub-CPMK0129', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],
            ['cpmk_detail_id' => 20, 'cpmk_id' =>10,'sub_cpmk_kode'=>'Sub-CPMK0130', 'uraian_sub_cpmk' => 'Kemampuan memahami aturan dan norma hukum'],

        ]);
    }
}
