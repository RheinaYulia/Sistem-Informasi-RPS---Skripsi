<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('s_menu')->upsert(
            [
            /////////////////////////////////
            //////////// ADMIN //////////////
            /////////////////////////////////

                //Parent 
                ['menu_id' => '1','menu_scope' => 'ALL','menu_code' => 'DASHBOARD','menu_name' => 'Dashboard','menu_url' => '/','menu_level' => '1','order_no' => '1','parent_id' => NULL,'class_tag' => 'dashboard','icon' => 'fas fa-tachometer-alt','is_active' => '1'],
                ['menu_id' => '2','menu_scope' => 'ADMIN','menu_code' => 'DOSEN','menu_name' => 'Data Dosen','menu_url' => NULL,'menu_level' => '1','order_no' => '2','parent_id' => NULL,'class_tag' => 'dosen','icon' => 'fas fa-solid fa-user-tie','is_active' => '1'],
                ['menu_id' => '3','menu_scope' => 'ADMIN','menu_code' => 'SETTING','menu_name' => 'Setting','menu_url' => NULL,'menu_level' => '1','order_no' => '7','parent_id' => NULL,'class_tag' => 'setting','icon' => 'fas fa-cogs','is_active' => '1'],
                
                //Level 2
                ['menu_id' => '4','menu_scope' => 'ADMIN','menu_code' => 'DOSEN.KELOLADOSEN','menu_name' => 'Dosen','menu_url' => 'dosen/kelola_dosen','menu_level' => '2','order_no' => '7','parent_id' => '2','class_tag' => 'dosen-kelola_dosen','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '5','menu_scope' => 'ADMIN','menu_code' => 'SETTING.MENU','menu_name' => 'Menu','menu_url' => 'setting/menu','menu_level' => '2','order_no' => '11','parent_id' => '3','class_tag' => 'setting-menu','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '6','menu_scope' => 'ADMIN','menu_code' => 'SETTING.GROUP','menu_name' => 'Group','menu_url' => 'setting/group','menu_level' => '2','order_no' => '12','parent_id' => '3','class_tag' => 'setting-group','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '7','menu_scope' => 'ADMIN','menu_code' => 'SETTING.USER','menu_name' => 'User','menu_url' => 'setting/user','menu_level' => '2','order_no' => '13','parent_id' => '3','class_tag' => 'setting-user','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '8','menu_scope' => 'ADMIN','menu_code' => 'SETTING.PERIODE','menu_name' => 'Periode','menu_url' => 'setting/periode','menu_level' => '2','order_no' => '14','parent_id' => '3','class_tag' => 'setting-peiode','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '9','menu_scope' => 'ALL','menu_code' => 'SETTING.ACCOUNT','menu_name' => 'Account','menu_url' => 'setting/account','menu_level' => '2','order_no' => '15','parent_id' => '3','class_tag' => 'setting-account','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                

            /////////////////////////////////
            //////// DOSEN //////////
            /////////////////////////////////

                //Parent
                ['menu_id' => '10','menu_scope' => 'DOSEN','menu_code' => 'MASTER','menu_name' => 'Data Master RPS','menu_url' => NULL,'menu_level' => '1','order_no' => '3','parent_id' => NULL,'class_tag' => 'master','icon' => 'fas fa-solid fa-bars','is_active' => '1'],
                ['menu_id' => '11','menu_scope' => 'DOSEN','menu_code' => 'RPS','menu_name' => 'RPS','menu_url' => NULL,'menu_level' => '1','order_no' => '4','parent_id' => NULL,'class_tag' => 'rps','icon' => 'fas fa-list-alt','is_active' => '1'],
                // ['menu_id' => '10','menu_scope' => 'DOSEN','menu_code' => 'KONTRAK','menu_name' => 'Kontrak Kuliah','menu_url' => NULL,'menu_level' => '1','order_no' => '4','parent_id' => NULL,'class_tag' => 'kontrak','icon' => 'fas fa-th','is_active' => '1'],
                // ['menu_id' => '11','menu_scope' => 'DOSEN','menu_code' => 'RPSIKU','menu_name' => 'RPS IKU','menu_url' => NULL,'menu_level' => '1','order_no' => '5','parent_id' => NULL,'class_tag' => 'rpsiku','icon' => 'fas fa-th','is_active' => '1'],

                //Level 2
                ['menu_id' => '12','menu_scope' => 'DOSEN','menu_code' => 'MASTER.MEDIA','menu_name' => 'Kelola Media','menu_url' => 'master/media','menu_level' => '2','order_no' => '16','parent_id' => '10','class_tag' => 'master-media','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '13','menu_scope' => 'DOSEN','menu_code' => 'MASTER.PUSTAKA','menu_name' => 'Kelola Pustaka','menu_url' => 'master/pustaka','menu_level' => '2','order_no' => '17','parent_id' => '10','class_tag' => 'master-pustaka','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '14','menu_scope' => 'DOSEN','menu_code' => 'RPS.RPS','menu_name' => 'RPS','menu_url' => 'rps/detail_rps','menu_level' => '2','order_no' => '19','parent_id' => '11','class_tag' => 'rps-detail_rps','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                // ['menu_id' => '13','menu_scope' => 'DOSEN','menu_code' => 'KONTRAK.KULIAH','menu_name' => 'Kelola Kontrak Kuliah','menu_url' => 'kontrak/kelola_kontrak','menu_level' => '2','order_no' => '21','parent_id' => '10','class_tag' => 'kontrak-kelola_kontrak','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                // ['menu_id' => '14','menu_scope' => 'DOSEN','menu_code' => 'RPSIKU.RPSIKU','menu_name' => 'Kelola RPS IKU','menu_url' => 'rpsiku/kelola_rpsiku','menu_level' => '2','order_no' => '22','parent_id' => '11','class_tag' => 'rpsiku-kelola_rpsiku','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '15','menu_scope' => 'DOSEN','menu_code' => 'RPS.KELOLARPS','menu_name' => 'Kelola RPS','menu_url' => 'rps/kelola_rps','menu_level' => '2','order_no' => '20','parent_id' => '11','class_tag' => 'rps-kelola_rps','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '16','menu_scope' => 'DOSEN','menu_code' => 'RPS.KELOLAMASTER','menu_name' => 'Kelola Data RPS','menu_url' => 'rps/kelola_master','menu_level' => '2','order_no' => '21','parent_id' => '11','class_tag' => 'rps-kelola_master','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                // ['menu_id' => '17','menu_scope' => 'DOSEN','menu_code' => 'RPS.KELOLABAB','menu_name' => 'Kelola Bab RPS','menu_url' => 'rps/kelola_bab','menu_level' => '2','order_no' => '21','parent_id' => '11','class_tag' => 'rps-kelola_bab','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                ['menu_id' => '17','menu_scope' => 'DOSEN','menu_code' => 'RPS.STATUSVER','menu_name' => 'Status RPS','menu_url' => 'rps/status_ver','menu_level' => '2','order_no' => '22','parent_id' => '11','class_tag' => 'rps-status_ver','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                // ['menu_id' => '19','menu_scope' => 'DOSEN','menu_code' => 'RPS.STATUSSAH','menu_name' => 'Ajukan Pengesahan','menu_url' => 'rps/status_sah','menu_level' => '2','order_no' => '23','parent_id' => '11','class_tag' => 'rps-status_sah','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                

                //level 3
                
            
                /////////////////////////////////
            //////// DOSEN KURIKULUM //////////
            /////////////////////////////////

                
                ['menu_id' => '18','menu_scope' => 'DOSEN KURIKULUM','menu_code' => 'VERIFIKASI','menu_name' => 'Verifikasi','menu_url' => NULL,'menu_level' => '1','order_no' => '5','parent_id' => NULL,'class_tag' => 'verifikasi','icon' => 'fas fa-tasks','is_active' => '1'],
                //Level 2
                ['menu_id' => '19','menu_scope' => 'DOSEN KURIKULUM','menu_code' => 'VERIFIKASI.RPS','menu_name' => 'Verifikasi RPS','menu_url' => 'rps/verifikasi','menu_level' => '2','order_no' => '24','parent_id' => '18','class_tag' => 'verifikasi-rps','icon' => 'fas fa-minus text-xs','is_active' => '1'],
                
                /////////////////////////////////
            //////// KAPRODI //////////
            /////////////////////////////////

            ['menu_id' => '20','menu_scope' => 'KAPRODI','menu_code' => 'PENGESAHAN','menu_name' => 'Pengesahan','menu_url' => NULL,'menu_level' => '1','order_no' => '6','parent_id' => NULL,'class_tag' => 'pengesahan','icon' => 'fas fa-vote-yea','is_active' => '1'],
            //Level 2
            ['menu_id' => '21','menu_scope' => 'KAPRODI','menu_code' => 'PENGESAHAN.RPS','menu_name' => 'Pengesahan RPS','menu_url' => 'rps/pengesahan','menu_level' => '2','order_no' => '25','parent_id' => '20','class_tag' => 'pengesahan-rps','icon' => 'fas fa-minus text-xs','is_active' => '1'],


            ['menu_id' => '22','menu_scope' => 'DOSEN','menu_code' => 'MASTER.BK','menu_name' => 'Kelola Bahan Kajian','menu_url' => 'master/bk','menu_level' => '2','order_no' => '18','parent_id' => '10','class_tag' => 'master-bk','icon' => 'fas fa-minus text-xs','is_active' => '1'],
            


            ],
            ['menu_id', 'menu_code'],
            ['menu_scope', 'menu_name', 'menu_url', 'class_tag']
        );
    }
}
