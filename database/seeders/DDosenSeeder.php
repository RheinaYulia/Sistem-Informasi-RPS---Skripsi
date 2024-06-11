<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_dosen')->insert([
            ['dosen_id' => 1, 'user_id'=> 2, 'nama_dosen' => 'Dosen 1'],
            ['dosen_id' => 2, 'user_id'=> 2, 'nama_dosen' => 'Dosen 2'],
            ['dosen_id' => 3, 'user_id'=> 3,'nama_dosen' => 'Dosen Kurikulum 1'],
            ['dosen_id' => 4, 'user_id'=> 3,'nama_dosen' => 'Dosen Kurikulum 2'],
            ['dosen_id' => 5, 'user_id'=> 4,'nama_dosen' => 'Kaprodi TI'],
            ['dosen_id' => 6, 'user_id'=> 4,'nama_dosen' => 'Kaprodi SIB'],
        ]);
    }
}
