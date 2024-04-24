<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('s_group')->insert([
            ['group_id' => 1, 'group_code' => 'ADM', 'group_name' => 'Admin'],
            ['group_id' => 2, 'group_code' => 'TTC', 'group_name' => 'Team Teaching'],
            ['group_id' => 3, 'group_code' => 'DKR', 'group_name' => 'Dosen Kurikulum'],
            ['group_id' => 4, 'group_code' => 'KPR', 'group_name' => 'Kaprodi'],
            ['group_id' => 5, 'group_code' => 'DSN', 'group_name' => 'Dosen'],
        ]);
    }
}
