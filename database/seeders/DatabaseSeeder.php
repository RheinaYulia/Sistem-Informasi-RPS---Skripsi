<?php

namespace Database\Seeders;

use DCpmk;
use DKaprodi;
use Illuminate\Database\Seeder;
use MCplProdi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SDateSeeder::class,
            SGroupSeeder::class,
            SUserSeeder::class,
            SMenuSeeder::class,
            SGroupMenuSeeder::class,
            
            MatkulSeeder::class,
            MProdiSeeder::class,
            DDosenSeeder::class,
            MPeriode::class,
            DKurikulumSeeder::class,
            DRumpunMKSeeder::class,
            DKaprodiSeeder::class,
            DKurikulumMKSeeder::class,
            MCplProdiSeeder::class,
            DCpmkSeeder::class,
            MBkSeeder::class,
            TCplCpmkSeeder::class,
            TMkBkSeeder::class,
            DCpmkDetailSeeder::class,
            MKakel::class,
        ]);
    }
}
