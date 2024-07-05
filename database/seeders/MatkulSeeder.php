<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_mk')->insert([
            ['mk_id' => 1, 'mk_nama' => 'Tata Kelola Teknologi Informasi','mk_jenis' => 'jenis1'],
            ['mk_id' => 2, 'mk_nama' => 'Komputasi Multimedia','mk_jenis' => 'jenis2'],
            ['mk_id' => 3, 'mk_nama' => 'Audit Sistem Informasi ','mk_jenis' => 'jenis3'],
            ['mk_id' => 4, 'mk_nama' => 'Agama','mk_jenis' => 'jenis4'],
            ['mk_id' => 5, 'mk_nama' => 'Bahasa Indonesia','mk_jenis' => 'jenis5'],
            ['mk_id' => 6, 'mk_nama' => 'Bahasa Inggris Dasar','mk_jenis' => 'jenis6'],
            ['mk_id' => 7, 'mk_nama' => 'Konsep Teknologi informasi','mk_jenis' => 'jenis7'],
            ['mk_id' => 8, 'mk_nama' => 'Critical Thingking and Problem Solving','mk_jenis' => 'jenis8'],
            ['mk_id' => 9, 'mk_nama' => 'Pengantar Akuntansi, Manajemen, dan Bisnis','mk_jenis' => 'jenis9'],
            ['mk_id' => 10, 'mk_nama' => 'Matematika Dasar','mk_jenis' => 'jenis10'],
            ['mk_id' => 11, 'mk_nama' => 'Dasar Pemrograman','mk_jenis' => 'jenis11'],
            ['mk_id' => 12, 'mk_nama' => 'Praktikum Dasar Pemrograman','mk_jenis' => 'jenis12'],
            ['mk_id' => 13, 'mk_nama' => 'Kewarganegaraan','mk_jenis' => 'jenis13'],
            ['mk_id' => 14, 'mk_nama' => 'Analisa Proses Bisnis','mk_jenis' => 'jenis14'],
            ['mk_id' => 15, 'mk_nama' => 'Praktikum Analisa Proses Bisnis','mk_jenis' => 'jenis15'],
            ['mk_id' => 16, 'mk_nama' => 'Pengenalan Sistem Informasi', 'mk_jenis' => 'jenis16'],
            ['mk_id' => 17, 'mk_nama' => 'Algoritma dan Struktur Data', 'mk_jenis' => 'jenis17'],
            ['mk_id' => 18, 'mk_nama' => 'Praktikum Algoritma dan Struktur Data', 'mk_jenis' => 'jenis18'],
            ['mk_id' => 19, 'mk_nama' => 'Basis Data', 'mk_jenis' => 'jenis19'],
            ['mk_id' => 20, 'mk_nama' => 'Praktikum Basis Data', 'mk_jenis' => 'jenis20'],
            ['mk_id' => 21, 'mk_nama' => 'Matematika Lanjut', 'mk_jenis' => 'jenis21'],
            ['mk_id' => 22, 'mk_nama' => 'Sistem Operasi', 'mk_jenis' => 'jenis22'],
            ['mk_id' => 23, 'mk_nama' => 'Jaringan Komputer', 'mk_jenis' => 'jenis23'],
            ['mk_id' => 24, 'mk_nama' => 'Praktikum Jaringan Komputer', 'mk_jenis' => 'jenis24'],
            ['mk_id' => 25, 'mk_nama' => 'Rekayasa Perangkat Lunak', 'mk_jenis' => 'jenis25'],
            ['mk_id' => 26, 'mk_nama' => 'Pemrograman Berbasis Objek', 'mk_jenis' => 'jenis26'],
            ['mk_id' => 27, 'mk_nama' => 'Praktikum Pemrograman Berbasis Objek', 'mk_jenis' => 'jenis27'],
            ['mk_id' => 28, 'mk_nama' => 'Basis Data Lanjut', 'mk_jenis' => 'jenis28'],
            ['mk_id' => 29, 'mk_nama' => 'Praktikum Basis Data Lanjut', 'mk_jenis' => 'jenis29'],
            ['mk_id' => 30, 'mk_nama' => 'Pemrograman Web', 'mk_jenis' => 'jenis30'],
            ['mk_id' => 31, 'mk_nama' => 'Pancasila', 'mk_jenis' => 'jenis31'],
            ['mk_id' => 32, 'mk_nama' => 'Statistika', 'mk_jenis' => 'jenis32'],
            ['mk_id' => 33, 'mk_nama' => 'Bahasa Inggris Lanjut', 'mk_jenis' => 'jenis33'],
            ['mk_id' => 34, 'mk_nama' => 'Workshop', 'mk_jenis' => 'jenis34'],
            ['mk_id' => 35, 'mk_nama' => 'Data Warehouse', 'mk_jenis' => 'jenis35'],
            ['mk_id' => 36, 'mk_nama' => 'Data Mining', 'mk_jenis' => 'jenis36'],
            ['mk_id' => 37, 'mk_nama' => 'Analisis dan Perancangan Sistem Informasi', 'mk_jenis' => 'jenis37'],
            ['mk_id' => 38, 'mk_nama' => 'Pemrograman Web Lanjut', 'mk_jenis' => 'jenis38'],
            ['mk_id' => 39, 'mk_nama' => 'Metodologi Penelitian', 'mk_jenis' => 'jenis40'],
            ['mk_id' => 40, 'mk_nama' => 'Manajemen Rantai Pasok', 'mk_jenis' => 'jenis42'],
            ['mk_id' => 41, 'mk_nama' => 'Perencanaan Sumber Daya', 'mk_jenis' => 'jenis43'],
            ['mk_id' => 42, 'mk_nama' => 'Kecerdasan Bisnis', 'mk_jenis' => 'jenis44'],
            ['mk_id' => 43, 'mk_nama' => 'Penjaminan Mutu Perangkat Lunak', 'mk_jenis' => 'jenis45'],
            ['mk_id' => 44, 'mk_nama' => 'Pemrograman Mobile', 'mk_jenis' => 'jenis46'],
            ['mk_id' => 45, 'mk_nama' => 'Manajemen Proyek Sistem Informasi', 'mk_jenis' => 'jenis47'],
            ['mk_id' => 46, 'mk_nama' => 'Keselamatan dan Kesehatan Kerja', 'mk_jenis' => 'jenis48'],
            ['mk_id' => 47, 'mk_nama' => 'Manajemen Jaringan Komputer', 'mk_jenis' => 'jenis49'],
            ['mk_id' => 48, 'mk_nama' => 'Pengembangan Karir', 'mk_jenis' => 'jenis50'],
            ['mk_id' => 49, 'mk_nama' => 'Etika Profesi', 'mk_jenis' => 'jenis51'],
            ['mk_id' => 50, 'mk_nama' => 'Proyek Sistem Informasi', 'mk_jenis' => 'jenis52'],
            ['mk_id' => 51, 'mk_nama' => 'Pemasaran Digital', 'mk_jenis' => 'jenis53'],
            ['mk_id' => 52, 'mk_nama' => 'Manajemen Hubungan Pelanggan', 'mk_jenis' => 'jenis54'],
            ['mk_id' => 53, 'mk_nama' => 'Big Data', 'mk_jenis' => 'jenis55'],
            ['mk_id' => 54, 'mk_nama' => 'Praktik Kewirausahaan', 'mk_jenis' => 'jenis56'],
            ['mk_id' => 55, 'mk_nama' => 'Studi Kelayakan Rencana Bisnis', 'mk_jenis' => 'jenis57'],
            ['mk_id' => 56, 'mk_nama' => 'Produk Bisnis', 'mk_jenis' => 'jenis58'],
            ['mk_id' => 57, 'mk_nama' => 'Manajemen Bisnis', 'mk_jenis' => 'jenis59'],
            ['mk_id' => 58, 'mk_nama' => 'Pemasaran Bisnis', 'mk_jenis' => 'jenis60'],
            ['mk_id' => 59, 'mk_nama' => 'Capstone Project', 'mk_jenis' => 'jenis61'],
            ['mk_id' => 60, 'mk_nama' => 'Soft Skill/Kreativitas dan Inovasi TI', 'mk_jenis' => 'jenis62'],
            ['mk_id' => 61, 'mk_nama' => 'Rekayasa Teknologi Informasi', 'mk_jenis' => 'jenis63'],
            ['mk_id' => 62, 'mk_nama' => 'Kegiatan MBKM', 'mk_jenis' => 'jenis64'],
            ['mk_id' => 63, 'mk_nama' => 'Agama', 'mk_jenis' => 'jenis65'],
            ['mk_id' => 64, 'mk_nama' => 'Sistem Pendukung Keputusan', 'mk_jenis' => 'jenis66'],
            ['mk_id' => 65, 'mk_nama' => 'Sistem Operasi', 'mk_jenis' => 'jenis67'],
            ['mk_id' => 66, 'mk_nama' => 'Rekayasa Perangkat Lunak', 'mk_jenis' => 'jenis68'],
            ['mk_id' => 67, 'mk_nama' => 'Proyek Sistem Informasi', 'mk_jenis' => 'jenis69'],
            ['mk_id' => 68, 'mk_nama' => 'Praktikum Basis Data', 'mk_jenis' => 'jenis70'],
            ['mk_id' => 69, 'mk_nama' => 'Praktikum Algoritma dan Struktur Data', 'mk_jenis' => 'jenis71'],
            ['mk_id' => 70, 'mk_nama' => 'Penjaminan Mutu Perangkat Lunak', 'mk_jenis' => 'jenis72'],
            ['mk_id' => 71, 'mk_nama' => 'Pemrograman Web Lanjut', 'mk_jenis' => 'jenis73'],
            ['mk_id' => 72, 'mk_nama' => 'Pemrograman Berbasis Framework', 'mk_jenis' => 'jenis74'],
            ['mk_id' => 73, 'mk_nama' => 'Metodologi Penelitian', 'mk_jenis' => 'jenis75'],
            ['mk_id' => 74, 'mk_nama' => 'Kewarganegaraan', 'mk_jenis' => 'jenis76'],
            ['mk_id' => 75, 'mk_nama' => 'Internet of Things', 'mk_jenis' => 'jenis77'],
            ['mk_id' => 76, 'mk_nama' => 'Desain Antar Muka', 'mk_jenis' => 'jenis78'],
            ['mk_id' => 77, 'mk_nama' => 'Business Intelligence', 'mk_jenis' => 'jenis79'],
            ['mk_id' => 78, 'mk_nama' => 'Basis Data', 'mk_jenis' => 'jenis80'],
            ['mk_id' => 79, 'mk_nama' => 'Bahasa Indonesia', 'mk_jenis' => 'jenis81'],
            ['mk_id' => 80, 'mk_nama' => 'Aljabar Linear', 'mk_jenis' => 'jenis82'],
            ['mk_id' => 81, 'mk_nama' => 'Algoritma dan Struktur Data', 'mk_jenis' => 'jenis83'],
            ['mk_id' => 82, 'mk_nama' => 'Agama', 'mk_jenis' => 'jenis84'],
        ]);
    }
}
