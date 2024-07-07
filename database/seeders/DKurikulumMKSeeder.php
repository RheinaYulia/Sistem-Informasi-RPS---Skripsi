<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DKurikulumMKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_kurikulum_mk')->insert([
            ['kurikulum_mk_id' => 1, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 1, 'prodi_id' => 2, 'kode_mk' => 'SIB208002', 'sks' => 3, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 2, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 2, 'prodi_id' => 1, 'kode_mk' => 'RTI186004', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 3, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 3, 'prodi_id' => 2, 'kode_mk' => 'SIB207104', 'sks' => 3, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 4, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 4, 'prodi_id' => 2, 'kode_mk' => 'SIB231001', 'sks' => 2, 'semester' => 1, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 5, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 5, 'prodi_id' => 2, 'kode_mk' => 'SIB231002', 'sks' => 2, 'semester' => 1, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 6, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 6, 'prodi_id' => 2, 'kode_mk' => 'SIB231003', 'sks' => 2, 'semester' => 1, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 7, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 7, 'prodi_id' => 2, 'kode_mk' => 'SIB231004', 'sks' => 2, 'semester' => 1, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 8, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 8, 'prodi_id' => 2, 'kode_mk' => 'SIB231005', 'sks' => 2, 'semester' => 1, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 9, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 9, 'prodi_id' => 2, 'kode_mk' => 'SIB231006', 'sks' => 2, 'semester' => 1, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 10, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 10, 'prodi_id' => 2, 'kode_mk' => 'SIB231007', 'sks' => 2, 'semester' => 1, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 11, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 11, 'prodi_id' => 2, 'kode_mk' => 'SIB231008', 'sks' => 2, 'semester' => 1, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 12, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 12, 'prodi_id' => 2, 'kode_mk' => 'SIB231009', 'sks' => 2, 'semester' => 1, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 13, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 13, 'prodi_id' => 2, 'kode_mk' => 'SIB232001', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 14, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 14, 'prodi_id' => 2, 'kode_mk' => 'SIB232002', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 15, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 15, 'prodi_id' => 2, 'kode_mk' => 'SIB232003', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 16, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 16, 'prodi_id' => 2, 'kode_mk' => 'SIB232004', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 17, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 17, 'prodi_id' => 2, 'kode_mk' => 'SIB232005', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 18, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 18, 'prodi_id' => 2, 'kode_mk' => 'SIB232006', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 19, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 19, 'prodi_id' => 2, 'kode_mk' => 'SIB232007', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 20, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 20, 'prodi_id' => 2, 'kode_mk' => 'SIB232008', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 21, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 21, 'prodi_id' => 2, 'kode_mk' => 'SIB232009', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 22, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 22, 'prodi_id' => 2, 'kode_mk' => 'SIB233001', 'sks' => 2, 'semester' => 3, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 23, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 23, 'prodi_id' => 2, 'kode_mk' => 'SIB233002', 'sks' => 2, 'semester' => 3, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 24, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 24, 'prodi_id' => 2, 'kode_mk' => 'SIB233003', 'sks' => 2, 'semester' => 3, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 25, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 25, 'prodi_id' => 2, 'kode_mk' => 'SIB233004', 'sks' => 2, 'semester' => 3, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 26, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 26, 'prodi_id' => 2, 'kode_mk' => 'SIB233005', 'sks' => 2, 'semester' => 3, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 27, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 27, 'prodi_id' => 2, 'kode_mk' => 'SIB233006', 'sks' => 2, 'semester' => 3, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 28, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 28, 'prodi_id' => 2, 'kode_mk' => 'SIB233007', 'sks' => 2, 'semester' => 3, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 29, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 29, 'prodi_id' => 2, 'kode_mk' => 'SIB233008', 'sks' => 2, 'semester' => 3, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 30, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 30, 'prodi_id' => 2, 'kode_mk' => 'SIB233009', 'sks' => 2, 'semester' => 3, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 31, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 31, 'prodi_id' => 2, 'kode_mk' => 'SIB234002', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 32, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 32, 'prodi_id' => 2, 'kode_mk' => 'SIB234003', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 33, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 33, 'prodi_id' => 2, 'kode_mk' => 'SIB234004', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 34, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 34, 'prodi_id' => 2, 'kode_mk' => 'SIB234005', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 35, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 35, 'prodi_id' => 2, 'kode_mk' => 'SIB234006', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 36, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 36, 'prodi_id' => 2, 'kode_mk' => 'SIB234007', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 37, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 37, 'prodi_id' => 2, 'kode_mk' => 'SIB234008', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 38, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 38, 'prodi_id' => 2, 'kode_mk' => 'SIB234009', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 39, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 39, 'prodi_id' => 2, 'kode_mk' => 'SIB235002', 'sks' => 2, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 40, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 40, 'prodi_id' => 2, 'kode_mk' => 'SIB235003', 'sks' => 2, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 41, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 41, 'prodi_id' => 2, 'kode_mk' => 'SIB235004', 'sks' => 2, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 42, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 42, 'prodi_id' => 2, 'kode_mk' => 'SIB235005', 'sks' => 2, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 43, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 43, 'prodi_id' => 2, 'kode_mk' => 'SIB235006', 'sks' => 2, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 44, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 44, 'prodi_id' => 2, 'kode_mk' => 'SIB235007', 'sks' => 2, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 45, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 45, 'prodi_id' => 2, 'kode_mk' => 'SIB235008', 'sks' => 2, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 46, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 46, 'prodi_id' => 2, 'kode_mk' => 'SIB235009', 'sks' => 2, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 47, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 47, 'prodi_id' => 2, 'kode_mk' => 'SIB236101', 'sks' => 2, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 48, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 48, 'prodi_id' => 2, 'kode_mk' => 'SIB236102', 'sks' => 2, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 49, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 49, 'prodi_id' => 2, 'kode_mk' => 'SIB236103', 'sks' => 2, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 50, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 50, 'prodi_id' => 2, 'kode_mk' => 'SIB236104', 'sks' => 6, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 12],
            ['kurikulum_mk_id' => 51, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 51, 'prodi_id' => 2, 'kode_mk' => 'SIB236105', 'sks' => 2, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 52, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 52, 'prodi_id' => 2, 'kode_mk' => 'SIB236106', 'sks' => 2, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 53, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 53, 'prodi_id' => 2, 'kode_mk' => 'SIB236107', 'sks' => 2, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 54, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 54, 'prodi_id' => 2, 'kode_mk' => 'SIB236201', 'sks' => 4, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 10],
            ['kurikulum_mk_id' => 55, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 55, 'prodi_id' => 2, 'kode_mk' => 'SIB236202', 'sks' => 4, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 10],
            ['kurikulum_mk_id' => 56, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 56, 'prodi_id' => 2, 'kode_mk' => 'SIB236203', 'sks' => 4, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 10],
            ['kurikulum_mk_id' => 57, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 57, 'prodi_id' => 2, 'kode_mk' => 'SIB236204', 'sks' => 4, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 10],
            ['kurikulum_mk_id' => 58, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 58, 'prodi_id' => 2, 'kode_mk' => 'SIB236205', 'sks' => 4, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 10],
            ['kurikulum_mk_id' => 59, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 59, 'prodi_id' => 2, 'kode_mk' => 'SIB236301', 'sks' => 8, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 16],
            ['kurikulum_mk_id' => 60, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 60, 'prodi_id' => 2, 'kode_mk' => 'SIB236302', 'sks' => 4, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 12],
            ['kurikulum_mk_id' => 61, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 61, 'prodi_id' => 2, 'kode_mk' => 'SIB236303', 'sks' => 4, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 12],
            ['kurikulum_mk_id' => 62, 'kurikulum_id' => 2, 'rumpun_mk_id' => null, 'mk_id' => 62, 'prodi_id' => 2, 'kode_mk' => 'SIB236401', 'sks' => 4, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 40],
            ['kurikulum_mk_id' => 63, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 63, 'prodi_id' => 1, 'kode_mk' => 'RTI214009', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 64, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 64, 'prodi_id' => 1, 'kode_mk' => 'RTI224001', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 65, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 65, 'prodi_id' => 1, 'kode_mk' => '', 'sks' => 3, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 66, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 66, 'prodi_id' => 1, 'kode_mk' => 'RTI232005', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 67, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 67, 'prodi_id' => 1, 'kode_mk' => 'RTI234009', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 0],
            ['kurikulum_mk_id' => 68, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 68, 'prodi_id' => 1, 'kode_mk' => 'RTI232007', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 69, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 69, 'prodi_id' => 1, 'kode_mk' => 'RTI232008', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 70, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 70, 'prodi_id' => 1, 'kode_mk' => 'RTI232009', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 71, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 71, 'prodi_id' => 1, 'kode_mk' => 'RTI234007', 'sks' => 3, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 6],
            ['kurikulum_mk_id' => 72, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 72, 'prodi_id' => 1, 'kode_mk' => 'RTI216002', 'sks' => 3, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 6],
            ['kurikulum_mk_id' => 73, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 73, 'prodi_id' => 1, 'kode_mk' => 'TI215101', 'sks' => 2, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 74, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 74, 'prodi_id' => 1, 'kode_mk' => '', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 75, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 75, 'prodi_id' => 1, 'kode_mk' => 'RTI216005', 'sks' => 3, 'semester' => 6, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 6],
            ['kurikulum_mk_id' => 76, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 76, 'prodi_id' => 1, 'kode_mk' => '', 'sks' => 0, 'semester' => 0, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 0],
            ['kurikulum_mk_id' => 77, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 77, 'prodi_id' => 1, 'kode_mk' => 'RTI234004', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 0],
            ['kurikulum_mk_id' => 78, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 78, 'prodi_id' => 1, 'kode_mk' => 'RTI212006', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 2],
            ['kurikulum_mk_id' => 79, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 79, 'prodi_id' => 1, 'kode_mk' => '', 'sks' => 0, 'semester' => 0, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 0],
            ['kurikulum_mk_id' => 80, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 80, 'prodi_id' => 1, 'kode_mk' => 'RTI234003', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 0],
            ['kurikulum_mk_id' => 81, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 81, 'prodi_id' => 1, 'kode_mk' => 'RTI232002', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 82, 'kurikulum_id' => 1, 'rumpun_mk_id' => null, 'mk_id' => 82, 'prodi_id' => 1, 'kode_mk' => 'RTI232008', 'sks' => 2, 'semester' => 2, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 83, 'kurikulum_id' => 4, 'rumpun_mk_id' => null, 'mk_id' => 1, 'prodi_id' => 2, 'kode_mk' => 'SIB208002', 'sks' => 3, 'semester' => 5, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
            ['kurikulum_mk_id' => 84, 'kurikulum_id' => 3, 'rumpun_mk_id' => null, 'mk_id' => 2, 'prodi_id' => 1, 'kode_mk' => 'RTI186004', 'sks' => 2, 'semester' => 4, 'kelompok_mk' => 'kelompok1', 'jumlah_jam' => 4],
        ]);        
    }
}
