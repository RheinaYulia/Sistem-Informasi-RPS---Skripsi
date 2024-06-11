<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DKaprodiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_kaprodi')->insert([
            ['kaprodi_id' => 1, 'prodi_id' => 1,'dosen_id'=>5,'tahun'=>'2023'],
            ['kaprodi_id' => 2, 'prodi_id' => 2,'dosen_id'=>6,'tahun'=>'2024'],
        ]);
    }
}
