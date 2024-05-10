<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TMkBkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('t_mk_bk')->insert([
            ['mk_bk_id' => 1, 'bk_id' => 1, 'mk_id' => 1],
            ['mk_bk_id' => 2, 'bk_id' => 2, 'mk_id' => 2],
            ['mk_bk_id' => 3, 'bk_id' => 3, 'mk_id' => 1],
            ['mk_bk_id' => 4, 'bk_id' => 4, 'mk_id' => 2],
            ['mk_bk_id' => 5, 'bk_id' => 5, 'mk_id' => 1],
            ['mk_bk_id' => 6, 'bk_id' => 6, 'mk_id' => 2],
            ['mk_bk_id' => 7, 'bk_id' => 7, 'mk_id' => 1],
            ['mk_bk_id' => 8, 'bk_id' => 8, 'mk_id' => 2],
            ['mk_bk_id' => 9, 'bk_id' => 9, 'mk_id' => 1],
            ['mk_bk_id' => 10, 'bk_id' => 10, 'mk_id' => 2],
        ]);
    }
}
