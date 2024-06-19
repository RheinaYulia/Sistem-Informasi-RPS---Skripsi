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
            ['mk_bk_id' => 2, 'bk_id' => 2, 'mk_id' => 1],
            ['mk_bk_id' => 3, 'bk_id' => 3, 'mk_id' => 1],
            ['mk_bk_id' => 4, 'bk_id' => 4, 'mk_id' => 1],
            ['mk_bk_id' => 5, 'bk_id' => 5, 'mk_id' => 1],
            ['mk_bk_id' => 6, 'bk_id' => 6, 'mk_id' => 1],
            ['mk_bk_id' => 7, 'bk_id' => 7, 'mk_id' => 1],
            ['mk_bk_id' => 8, 'bk_id' => 8, 'mk_id' => 1],
            ['mk_bk_id' => 9, 'bk_id' => 9, 'mk_id' => 1],
            ['mk_bk_id' => 10, 'bk_id' => 10, 'mk_id' => 2],
            ['mk_bk_id' => 11, 'bk_id' => 11, 'mk_id' => 2],
            ['mk_bk_id' => 12, 'bk_id' => 12, 'mk_id' => 2],
            ['mk_bk_id' => 13, 'bk_id' => 13, 'mk_id' => 2],
            ['mk_bk_id' => 14, 'bk_id' => 14, 'mk_id' => 2],
            ['mk_bk_id' => 15, 'bk_id' => 15, 'mk_id' => 2],
            ['mk_bk_id' => 16, 'bk_id' => 16, 'mk_id' => 2],
            ['mk_bk_id' => 17, 'bk_id' => 17, 'mk_id' => 2],
            ['mk_bk_id' => 18, 'bk_id' => 18, 'mk_id' => 2],
            ['mk_bk_id' => 19, 'bk_id' => 19, 'mk_id' => 3],
            ['mk_bk_id' => 20, 'bk_id' => 20, 'mk_id' => 3],
            ['mk_bk_id' => 21, 'bk_id' => 21, 'mk_id' => 3],
            ['mk_bk_id' => 22, 'bk_id' => 22, 'mk_id' => 3],
            ['mk_bk_id' => 23, 'bk_id' => 23, 'mk_id' => 3],
            ['mk_bk_id' => 24, 'bk_id' => 24, 'mk_id' => 3],
            ['mk_bk_id' => 25, 'bk_id' => 25, 'mk_id' => 3],
            ['mk_bk_id' => 26, 'bk_id' => 26, 'mk_id' => 3],
            ['mk_bk_id' => 27, 'bk_id' => 27, 'mk_id' => 3],
            ['mk_bk_id' => 28, 'bk_id' => 28, 'mk_id' => 3],
            ['mk_bk_id' => 29, 'bk_id' => 29, 'mk_id' => 3],
            ['mk_bk_id' => 30, 'bk_id' => 30, 'mk_id' => 3],
        ]);
    }
}
