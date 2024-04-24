<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('s_user')->insert([
            [
                'user_id'   => 1, // Super Admin
                'group_id'  => 1, // Super Admin
                'username'  => 'admin',
                'name'      => 'Administrator',
                'email'     => 'admin@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ],[
                'user_id'   => 2, // Admin
                'group_id'  => 2, // Admin
                'username'  => 'teamtc',
                'name'      => 'Team Teaching',
                'email'     => 'ttc@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ],[
                'user_id'   => 3, //
                'group_id'  => 3, // Dosen
                'username'  => 'dosenkurikulum',
                'name'      => 'Dosen Kurikulum',
                'email'     => 'dosenkurikulum@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ],
            [
                'user_id'   => 4, //
                'group_id'  => 4, // Mahasiswa
                'username'  => 'kaprodi',
                'name'      => 'Kaprodi',
                'email'     => 'kaprodi@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ],[
                'user_id'   => 5, //
                'group_id'  => 4, // Dosen
                'username'  => 'dosen',
                'name'      => 'Dosen',
                'email'     => 'dosen@admin.com',
                'password'  => password_hash('12345', PASSWORD_DEFAULT),
            ],
        ]);
    }
}
