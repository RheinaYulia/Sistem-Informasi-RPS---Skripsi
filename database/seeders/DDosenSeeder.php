<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('d_dosen')->insert([
            ['dosen_id' => 1, 'user_id'=> 2, 'nama_dosen' => 'Moch Zawaruddin Abdullah, S.ST., M.Kom.', 'nip' => '198902102019031019', 'nidn' => '0010028906', 'created_at' => now()],
            ['dosen_id' => 2, 'user_id'=> 3, 'nama_dosen' => 'Yoppy Yunhasnawa, S.ST., M.Sc.', 'nip' => '198906212019031013', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 3, 'user_id'=> 4, 'nama_dosen' => 'Habibie Ed Dien, S.Kom., M.T.', 'nip' => '199204122019031013', 'nidn' => '0012049209', 'created_at' => now()],
            ['dosen_id' => 4, 'user_id'=> 5, 'nama_dosen' => 'Noprianto, S.Kom., M.Eng', 'nip' => '198911082019031020', 'nidn' => '0511088901', 'created_at' => now()],
            ['dosen_id' => 5, 'user_id'=> 6, 'nama_dosen' => 'M. Hasyim ratsanjani, S.Kom., M.Kom.', 'nip' => '199003052019031013', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 6, 'user_id'=> 7, 'nama_dosen' => 'Ade Ismail S.Kom., M.TI', 'nip' => '199107042019031021', 'nidn' => '0404079101', 'created_at' => now()],
            ['dosen_id' => 7, 'user_id'=> 8, 'nama_dosen' => 'Adevian Fairuz Pratama, S.ST, M.Eng', 'nip' => '', 'nidn' => '8945260022', 'created_at' => now()],
            ['dosen_id' => 8, 'user_id'=> 9, 'nama_dosen' => 'Agung Nugroho Pramudhita, S.T., M.T.', 'nip' => '198902102019031020', 'nidn' => '0010028903', 'created_at' => now()],
            ['dosen_id' => 9, 'user_id'=> 10, 'nama_dosen' => 'Ahmadi Yuli Ananta, ST., M.M.', 'nip' => '198107052005011002', 'nidn' => '0005078102', 'created_at' => now()],
            ['dosen_id' => 10, 'user_id'=> 11, 'nama_dosen' => 'Annisa Puspa Kirana, S. Kom, M.Kom', 'nip' => '198901232019032016', 'nidn' => '0023018906', 'created_at' => now()],
            ['dosen_id' => 11, 'user_id'=> 12, 'nama_dosen' => 'Annisa Taufika Firdausi, ST., MT.', 'nip' => '198712142019032012', 'nidn' => '0023018906', 'created_at' => now()],
            ['dosen_id' => 12, 'user_id'=> 13, 'nama_dosen' => 'Anugrah Nur Rahmanto, S.Sn., M.Ds.', 'nip' => '199112302019031016', 'nidn' => '0030129101', 'created_at' => now()],
            ['dosen_id' => 13, 'user_id'=> 14, 'nama_dosen' => 'Ariadi Retno Tri Hayati Ririd, S.Kom., M.Kom.', 'nip' => '198108102005012002', 'nidn' => '0010088101', 'created_at' => now()],
            ['dosen_id' => 14, 'user_id'=> 15, 'nama_dosen' => 'Arie Rachmad Syulistyo, S.Kom., M.Kom', 'nip' => '198708242019031010', 'nidn' => '0024088701', 'created_at' => now()],
            ['dosen_id' => 15, 'user_id'=> 16, 'nama_dosen' => 'Arief Prasetyo, S.Kom., M.Kom., M.Pd.', 'nip' => '197903132008121002', 'nidn' => '0013037905', 'created_at' => now()],
            ['dosen_id' => 16, 'user_id'=> 17, 'nama_dosen' => 'Astrifidha Rahma Amalia,S.Pd., M.Pd.', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 17, 'user_id'=> 18, 'nama_dosen' => 'Atiqah Nurul Asri, S.Pd., M.Pd.', 'nip' => '197606252005012001', 'nidn' => '0025067607', 'created_at' => now()],
            ['dosen_id' => 18, 'user_id'=> 19, 'nama_dosen' => 'Bagas Satya Dian Nugraha, ST., MT.', 'nip' => '199006192019031017', 'nidn' => '0016069009', 'created_at' => now()],
            ['dosen_id' => 19, 'user_id'=> 20, 'nama_dosen' => 'Dr.Eng. Banni Satria Andoko, S. Kom., M.MSI.', 'nip' => '198108092010121002', 'nidn' => '0009088107', 'created_at' => now()],
            ['dosen_id' => 20, 'user_id'=> 21, 'nama_dosen' => 'Budi Harijanto, ST., M.MKom.', 'nip' => '196201051990031002', 'nidn' => '0005016211', 'created_at' => now()],
            ['dosen_id' => 21, 'user_id'=> 22, 'nama_dosen' => 'Cahya Rahmad, ST., M.Kom., Dr. Eng., Prof.', 'nip' => '197202022005011002', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 22, 'user_id'=> 23, 'nama_dosen' => 'Candra Bella Vista, S.Kom., MT.', 'nip' => '199412172019032020', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 23, 'user_id'=> 24, 'nama_dosen' => 'Candrasena Setiadi, ST., M.MT', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 24, 'user_id'=> 25, 'nama_dosen' => 'Deddy Kusbianto PA, Ir., M.Mkom.', 'nip' => '196211281988111001', 'nidn' => '0028116204', 'created_at' => now()],
            ['dosen_id' => 25, 'user_id'=> 26, 'nama_dosen' => 'Dhebys Suryani, S.Kom., MT', 'nip' => '198311092014042001', 'nidn' => '0009118305', 'created_at' => now()],
            ['dosen_id' => 26, 'user_id'=> 27, 'nama_dosen' => 'Dian Hanifudin Subhi, S.Kom., M.Kom.', 'nip' => '198806102019031018', 'nidn' => '0010068807', 'created_at' => now()],
            ['dosen_id' => 27, 'user_id'=> 28, 'nama_dosen' => 'Dika Rizky Yunianto, S.Kom, M.Kom', 'nip' => '199206062019031017', 'nidn' => '0006069202', 'created_at' => now()],
            ['dosen_id' => 28, 'user_id'=> 29, 'nama_dosen' => 'Dimas Wahyu Wibowo, ST., MT.', 'nip' => '198410092015041001', 'nidn' => '0009108402', 'created_at' => now()],
            ['dosen_id' => 29, 'user_id'=> 30, 'nama_dosen' => 'Dr. Ely Setyo Astuti, S.T., M.T.', 'nip' => '197605152009122001', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 30, 'user_id'=> 31, 'nama_dosen' => 'Dr. Rakhmat Arianto, S.ST., M.Kom.', 'nip' => '198701082019031004', 'nidn' => '0308018702', 'created_at' => now()],
            ['dosen_id' => 31, 'user_id'=> 32, 'nama_dosen' => 'Dr. Ulla Delfana Rosiani, ST., MT.', 'nip' => '197803272003122002', 'nidn' => '0027037801', 'created_at' => now()],
            ['dosen_id' => 32, 'user_id'=> 33, 'nama_dosen' => 'Dwi Puspitasari, S.Kom., M.Kom.', 'nip' => '197911152005012002', 'nidn' => '0015117903', 'created_at' => now()],
            ['dosen_id' => 33, 'user_id'=> 34, 'nama_dosen' => 'Eka Larasati Amalia, S.ST., MT.', 'nip' => '198807112015042005', 'nidn' => '0011078803', 'created_at' => now()],
            ['dosen_id' => 34, 'user_id'=> 35, 'nama_dosen' => 'Ekojono, ST., M.Kom.', 'nip' => '195912081985031004', 'nidn' => '0008125911', 'created_at' => now()],
            ['dosen_id' => 35, 'user_id'=> 36, 'nama_dosen' => 'Elok Nur Hamdana, S.T., M.T', 'nip' => '198610022019032011', 'nidn' => '0702108601', 'created_at' => now()],
            ['dosen_id' => 36, 'user_id'=> 37, 'nama_dosen' => 'Endah Septa Sintiya. SPd., MKom.', 'nip' => '199401312022032007', 'nidn' => '0031019404', 'created_at' => now()],
            ['dosen_id' => 37, 'user_id'=> 38, 'nama_dosen' => 'Erfan Rohadi, ST., M.Eng., Ph.D.', 'nip' => '197201232008011006', 'nidn' => '0023017206', 'created_at' => now()],
            ['dosen_id' => 38, 'user_id'=> 39, 'nama_dosen' => 'Faiz Ushbah Mubarok, S.Pd., M.Pd.', 'nip' => '199305052019031018', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 39, 'user_id'=> 40, 'nama_dosen' => 'Farid Angga Pribadi, S.Kom.,M.Kom', 'nip' => '198910072020121003', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 40, 'user_id'=> 41, 'nama_dosen' => 'Farida Ulfa, S.Pd., M.Pd.', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 41, 'user_id'=> 42, 'nama_dosen' => 'Gunawan Budi Prasetyo, ST., MMT., Ph.D.', 'nip' => '197704242008121001', 'nidn' => '0024047706', 'created_at' => now()],
            ['dosen_id' => 42, 'user_id'=> 43, 'nama_dosen' => 'Hendra Pradibta, SE., M.Sc.', 'nip' => '198305212006041003', 'nidn' => '0021058301', 'created_at' => now()],
            ['dosen_id' => 43, 'user_id'=> 44, 'nama_dosen' => 'Ika Kusumaning Putri, MT.', 'nip' => '199110142019032020', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 44, 'user_id'=> 45, 'nama_dosen' => 'Imam Fahrur Rozi, ST., MT.', 'nip' => '198406102008121004', 'nidn' => '0010068402', 'created_at' => now()],
            ['dosen_id' => 45, 'user_id'=> 46, 'nama_dosen' => 'Indra Dharma Wijaya, ST., M.MT.', 'nip' => '197305102008011010', 'nidn' => '0010057308', 'created_at' => now()],
            ['dosen_id' => 46, 'user_id'=> 47, 'nama_dosen' => 'Irsyad Arif Mashudi, M.Kom', 'nip' => '198902012019031009', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 47, 'user_id'=> 48, 'nama_dosen' => 'Kadek Suarjuna Batubulan, S.Kom, MT', 'nip' => '199003202019031016', 'nidn' => '0720039003', 'created_at' => now()],
            ['dosen_id' => 48, 'user_id'=> 49, 'nama_dosen' => 'Luqman Affandi, S.Kom., MMSI', 'nip' => '198211302014041001', 'nidn' => '0730118201', 'created_at' => now()],
            ['dosen_id' => 49, 'user_id'=> 50, 'nama_dosen' => "Mamluatul Hani'ah, S.Kom., M.Kom.", 'nip' => '199002062019032013', 'nidn' => '0006029003', 'created_at' => now()],
            ['dosen_id' => 50, 'user_id'=> 51, 'nama_dosen' => 'Marsma TNI Dr. Ir. Arwin Datumaya Wahyudi Sumari, S.T., M.T., IPU, ASEAN Eng., ACPE', 'nip' => '515561', 'nidn' => '47210569', 'created_at' => now()],
            ['dosen_id' => 51, 'user_id'=> 52, 'nama_dosen' => 'Meyti Eka Apriyani ST., MT.', 'nip' => '198704242019032017', 'nidn' => '1024048703', 'created_at' => now()],
            ['dosen_id' => 52, 'user_id'=> 53, 'nama_dosen' => 'Milyun Nima Shoumi, S.Kom., M.Kom', 'nip' => '198805072019032012', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 53, 'user_id'=> 54, 'nama_dosen' => 'Muhammad Afif Hendrawan., S.Kom., M.T.', 'nip' => '199111282019031013', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 54, 'user_id'=> 55, 'nama_dosen' => 'Muhammad Shulhan Khairy, S.Kom, M.Kom', 'nip' => '199205172019031020', 'nidn' => '0017059201', 'created_at' => now()],
            ['dosen_id' => 55, 'user_id'=> 56, 'nama_dosen' => 'Muhammad Unggul Pamenang, S.St., M.T.', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 56, 'user_id'=> 57, 'nama_dosen' => 'Mungki Astiningrum, ST., M.Kom.', 'nip' => '197710302005012001', 'nidn' => '0030107702', 'created_at' => now()],
            ['dosen_id' => 57, 'user_id'=> 58, 'nama_dosen' => 'Mustika Mentari, S.Kom., M.Kom', 'nip' => '198806072019032016', 'nidn' => '0007068804', 'created_at' => now()],
            ['dosen_id' => 58, 'user_id'=> 59, 'nama_dosen' => 'Muthrofin', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 59, 'user_id'=> 60, 'nama_dosen' => 'Pramana Yoga Saputra, S.Kom., MMT.', 'nip' => '198805042015041001', 'nidn' => '0004058805', 'created_at' => now()],
            ['dosen_id' => 60, 'user_id'=> 61, 'nama_dosen' => 'Putra Prima A., ST., M.Kom.', 'nip' => '198611032014041001', 'nidn' => '0003118602', 'created_at' => now()],
            ['dosen_id' => 61, 'user_id'=> 62, 'nama_dosen' => 'Retno Damayanti, S.Pd., M.T.', 'nip' => '198910042019032023', 'nidn' => '0004108907', 'created_at' => now()],
            ['dosen_id' => 62, 'user_id'=> 63, 'nama_dosen' => 'Ridwan Rismanto, SST., M.Kom.', 'nip' => '198603182012121001', 'nidn' => '0018038602', 'created_at' => now()],
            ['dosen_id' => 63, 'user_id'=> 64, 'nama_dosen' => 'Robby Anggriawan SE., ME.', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 64, 'user_id'=> 65, 'nama_dosen' => 'Rokhimatul Wakhidah, S.Pd., M.T.', 'nip' => '198903192019032013', 'nidn' => '0019038905', 'created_at' => now()],
            ['dosen_id' => 65, 'user_id'=> 66, 'nama_dosen' => 'Dr. Eng. Rosa Andrie Asmara, ST., MT.', 'nip' => '198903192019032013', 'nidn' => '0010108003', 'created_at' => now()],
            ['dosen_id' => 66, 'user_id'=> 67, 'nama_dosen' => 'Rudy Ariyanto, ST., M.Cs.', 'nip' => '197111101999031002', 'nidn' => '0010117109', 'created_at' => now()],
            ['dosen_id' => 67, 'user_id'=> 68, 'nama_dosen' => 'Satrio Binusa S, SS, M.Pd', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 68, 'user_id'=> 69, 'nama_dosen' => 'Septian Enggar Sukmana, S.Pd., M.T', 'nip' => '198909012019031010', 'nidn' => '0601098901', 'created_at' => now()],
            ['dosen_id' => 69, 'user_id'=> 70, 'nama_dosen' => 'Sofyan Noor Arief, S.ST., M.Kom.', 'nip' => '198908132019031017', 'nidn' => '0013088904', 'created_at' => now()],
            ['dosen_id' => 70, 'user_id'=> 71, 'nama_dosen' => 'Triana Fatmawati, S.T., M.T.', 'nip' => '198005142005022001', 'nidn' => '4314058001', 'created_at' => now()],
            ['dosen_id' => 71, 'user_id'=> 72, 'nama_dosen' => 'Usman Nurhasan, S.Kom., MT.', 'nip' => '198609232015041001', 'nidn' => '0023098604', 'created_at' => now()],
            ['dosen_id' => 72, 'user_id'=> 73, 'nama_dosen' => 'Very Sugiarto, S.Pd', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 73, 'user_id'=> 74, 'nama_dosen' => 'Vipkas Al Hadid Firdaus, ST,. MT', 'nip' => '199105052019031029', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 74, 'user_id'=> 75, 'nama_dosen' => 'Vit Zuraida, S.Kom., M.Kom.', 'nip' => '198901092020122005', 'nidn' => '0009018910', 'created_at' => now()],
            ['dosen_id' => 75, 'user_id'=> 76, 'nama_dosen' => 'Vivi Nur Wijayaningrum, S.Kom, M.Kom', 'nip' => '199308112019032025', 'nidn' => '0011089303', 'created_at' => now()],
            ['dosen_id' => 76, 'user_id'=> 77, 'nama_dosen' => 'Vivin Ayu Lestari, S.Pd., M.Kom', 'nip' => '199106212019032020', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 77, 'user_id'=> 78, 'nama_dosen' => 'Widaningsih Condrowardhani, SH, MH.', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 78, 'user_id'=> 79, 'nama_dosen' => 'Wilda Imama Sabilla, S.Kom., M.Kom.', 'nip' => '199208292019032023', 'nidn' => '0029089201', 'created_at' => now()],
            ['dosen_id' => 79, 'user_id'=> 80, 'nama_dosen' => 'Yan Watequlis Syaifudin, ST., M.MT., Ph.D.', 'nip' => '198101052005011005', 'nidn' => '0005018104', 'created_at' => now()],
            ['dosen_id' => 80, 'user_id'=> 81, 'nama_dosen' => 'Yuri Ariyanto, S.Kom., M.Kom.', 'nip' => '198007162010121002', 'nidn' => '0016078008', 'created_at' => now()],
            ['dosen_id' => 81, 'user_id'=> 82, 'nama_dosen' => 'Dodit Suprianto', 'nip' => '', 'nidn' => '716037502', 'created_at' => now()],
            ['dosen_id' => 82, 'user_id'=> 83, 'nama_dosen' => 'Dosen Kurikulum', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 83, 'user_id'=> 84, 'nama_dosen' => 'Kaprodi TI', 'nip' => '', 'nidn' => '', 'created_at' => now()],
            ['dosen_id' => 84, 'user_id'=> 85, 'nama_dosen' => 'Kaprodi SIB', 'nip' => '', 'nidn' => '', 'created_at' => now()],
        ]);
    }
}
