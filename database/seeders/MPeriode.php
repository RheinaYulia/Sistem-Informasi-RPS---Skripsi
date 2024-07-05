<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MPeriode extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_periode')->insert([
            ['periode_id' => 1, 'periode_name' => 'Ganjil', 'is_active' => 1],
            ['periode_id' => 1, 'periode_name' => 'Genap', 'is_active' => 1],
        ]);
    }
}
