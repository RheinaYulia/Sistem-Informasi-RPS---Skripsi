<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DKurikulumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_kurikulum')->insert([
            ['kurikulum_id' => 1, 'prodi_id' => 1, 'kurikulum_tahun' => '2024'],
            ['kurikulum_id' => 2, 'prodi_id' => 2, 'kurikulum_tahun' => '2024'],
        ]);
    }
}
