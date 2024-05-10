<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SGroupMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_super = [];
        $menu_admin = [];
        $menu_dokur = [];
        $menu_kaprodi = [];
        for ($i = 1; $i <= 22; $i++) {
            if ($i === 17 || $i === 19) {
                $menu_dokur[] = ['group_id'  => 3, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
            } if ($i === 1 || ($i >= 11 && $i <= 16)) {
                $menu_admin[] = ['group_id'  => 2, 'menu_id'   => $i, 'c'   => 0, 'r'    => 1, 'u'   => 0, 'd' => 0];
                $menu_kaprodi[] = ['group_id'  => 4, 'menu_id'   => $i, 'c'   => 0, 'r'    => 1, 'u'   => 0, 'd' => 0];
                $menu_dokur[] = ['group_id'  => 3, 'menu_id'   => $i, 'c'   => 0, 'r'    => 1, 'u'   => 0, 'd' => 0];
            } if($i === 18 || ($i >= 18 && $i <= 22)) {
                $menu_kaprodi[] = ['group_id'  => 4, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
                $menu_admin[] = ['group_id'  => 2, 'menu_id'   => $i, 'c'   => 0, 'r'    => 1, 'u'   => 0, 'd' => 0];
                $menu_dokur[] = ['group_id'  => 3, 'menu_id'   => $i, 'c'   => 0, 'r'    => 1, 'u'   => 0, 'd' => 0];
            }
                $menu_super[] = ['group_id'  => 1, 'menu_id'   => $i, 'c'   => 1, 'r'    => 1, 'u'   => 1, 'd' => 1];
            
        }

        DB::table('s_group_menu')->insert($menu_super);
        DB::table('s_group_menu')->insert($menu_admin);
        DB::table('s_group_menu')->insert($menu_dokur);
        DB::table('s_group_menu')->insert($menu_kaprodi);
    }
}
