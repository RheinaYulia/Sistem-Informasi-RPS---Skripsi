<?php

namespace App\Models\Rps;

use App\Models\AppModel;
use App\Models\KurikulumMKModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RpsBabModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_rps_bab';
    protected $primaryKey = 'bab_id';

    protected static $_table = 'd_rps_bab';
    protected static $_primaryKey = 'bab_id';

    protected $fillable = [
        'rps_id',
        'bab_id',
        'rps_bab',
        'sub_cpmk',
        'materi',
        'estimasi_waktu',
        'pengalaman_belajar',
        'indikator_penilaian',
        'bobot_penilaian',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    protected static $cascadeDelete = false;   //  True: Force Delete from Parent (cascade)
    protected static $childModel = [
        //  Model => columnFK
        //'App\Models\Master\EmployeeModel' => 'jabatan_id'
    ];

    public static function spInsertOrUpdateBab($rps_id, array $bab_id, array $rps_bab, array $sub_cpmk, 
    array $materi, array $estimasi_waktu, array $pengalaman_belajar, array $indikator_penilaian, array $bobot_penilaian, array $bentuk_pembelajaran, array $metode_pembelajaran)
{
    DB::beginTransaction();

    try {
        foreach ($bab_id as $index => $bab) {
            // Cek apakah bab_id dan rps_id sudah ada dalam tabel d_rps_bab
            $existingBab = DB::table('d_rps_bab')
                            ->where('rps_id', $rps_id)
                            ->where('bab_id', $bab) 
                            ->first();

            if ($existingBab) {
                // Jika sudah ada, lakukan pembaruan pada d_rps_bab
                DB::table('d_rps_bab')
                    ->where('rps_id', $rps_id)
                    ->where('bab_id', $bab)
                    ->update([
                        'rps_bab' => $rps_bab[$index], 
                        'sub_cpmk' => $sub_cpmk[$index],
                        'materi' => $materi[$index],
                        'estimasi_waktu' => $estimasi_waktu[$index],
                        'pengalaman_belajar' => $pengalaman_belajar[$index],
                        'indikator_penilaian' => $indikator_penilaian[$index],
                        'bobot_penilaian' => $bobot_penilaian[$index]
                    ]);
            } 

            // Cek apakah bab_id sudah ada dalam tabel d_rps_metode
            $existingMetode = DB::table('d_rps_metode')
                                ->where('bab_id', $bab)
                                ->first();

            if ($existingMetode) {
                // Jika sudah ada, lakukan pembaruan pada d_rps_metode
                DB::table('d_rps_metode')
                    ->where('bab_id', $bab)
                    ->update([
                        'bentuk_pembelajaran' => $bentuk_pembelajaran[$index],
                        'metode_pembelajaran' => $metode_pembelajaran[$index]
                    ]);
            } else {
                // Jika belum ada, lakukan penambahan pada d_rps_metode
                DB::table('d_rps_metode')->insert([
                    'bab_id' => $bab,
                    'bentuk_pembelajaran' => $bentuk_pembelajaran[$index],
                    'metode_pembelajaran' => $metode_pembelajaran[$index]
                ]);
            }
        }

        DB::commit();
        return true; // Jika transaksi berhasil
    } catch (\Exception $e) {
        DB::rollback();
        return false; // Jika terjadi kesalahan
    }
}

public static function spBabMateri($bab_id, $judul_materi, $file_url, $file_dir)
{
    DB::beginTransaction();

    try {
        // Cek apakah bab_id sudah ada dalam tabel d_rps_bab_materi
        $existingBab = DB::table('d_rps_bab_materi')
                        ->where('bab_id', $bab_id)
                        ->first();

        if ($existingBab) {
            // Jika sudah ada, lakukan pembaruan pada d_rps_bab_materi
            DB::table('d_rps_bab_materi')
                ->where('bab_id', $bab_id)
                ->update([
                    'judul_materi' => $judul_materi,
                    'file_url' => $file_url,
                    'updated_at' => now()
                ]);
        } else {
            // Jika belum ada, lakukan penyisipan data baru ke d_rps_bab_materi
            DB::table('d_rps_bab_materi')->insert([
                    'bab_id' => $bab_id,
                    'judul_materi' => $judul_materi,
                    'file_url' => $file_url,
                    'created_at' => now()
                ]);
        }

        DB::commit();
        return true; // Jika transaksi berhasil
    } catch (\Exception $e) {
        DB::rollback();
        Log::error('Error in spBabMateri: ' . $e->getMessage());
        return false; // Jika terjadi kesalahan
    }
}




    public static function getRpsBab($p_rps_id) {
        $rpsData = DB::table('m_rps')
                    ->select('m_rps.*', 
                            'd_rps_bab.bab_id AS bab_id', 
                             'd_rps_bab.rps_bab AS rps_bab',
                             'd_rps_bab.sub_cpmk AS sub_cpmk',
                             'd_rps_bab.materi AS materi',
                             'd_rps_bab.estimasi_waktu AS estimasi_waktu',
                             'd_rps_bab.pengalaman_belajar AS pengalaman_belajar',
                             'd_rps_bab.indikator_penilaian AS indikator_penilaian',
                             'd_rps_bab.bobot_penilaian AS bobot_penilaian',
                             'd_rps_metode.bentuk_pembelajaran AS bentuk_pembelajaran',
                             'd_rps_metode.metode_pembelajaran AS metode_pembelajaran')
                     ->leftJoin('d_rps_bab', 'm_rps.rps_id', '=', 'd_rps_bab.rps_id')
                     ->leftJoin('d_rps_metode', 'd_rps_bab.bab_id', '=', 'd_rps_metode.bab_id')
                     ->where('m_rps.rps_id', $p_rps_id)
                     ->get();
     
         return $rpsData;
    }

    public static function getBab($rps_id){
        $map = DB::table('d_rps_bab AS b')
            ->selectRaw('b.bab_id, b.rps_id, b.rps_bab')
            ->join('m_rps AS m', 'm.rps_id', '=', 'b.rps_id')
            ->where('b.rps_id', '=', $rps_id)
            ->whereNull('m.deleted_at')
            ->get();

        
        return $map;
    }

    public static function getPertemuan($bab_id){
        $map = DB::table('d_rps_bab AS b')
            ->selectRaw('b.bab_id, b.rps_id, b.rps_bab')
            ->join('m_rps AS m', 'm.rps_id', '=', 'b.rps_id')
            ->where('b.bab_id', '=', $bab_id)
            ->whereNull('m.deleted_at')
            ->get();

        
        return $map;
    }

    public static function getBabMetode($p_rps_id) {
        // Ambil data media terkait RPS
        $mediaData = DB::table('d_rps_media')
                    ->select('rps_media_id', 'jenis_media', 'nama_media')
                    ->where('rps_id', $p_rps_id)
                    ->whereNull('deleted_at')
                    ->get();
    
        return $mediaData;
    }

    public static function getBabById($rps_id, $bab_id)
{
    $result= DB::table('d_rps_bab AS b')
        ->select('b.bab_id', 
        'b.rps_id', 
        'b.rps_bab',
        'b.sub_cpmk',
        'b.materi',
        'b.estimasi_waktu',
        'b.pengalaman_belajar',
        'b.indikator_penilaian',
        'b.bobot_penilaian',
        'd_rps_metode.bentuk_pembelajaran AS bentuk_pembelajaran',
        'd_rps_metode.metode_pembelajaran AS metode_pembelajaran'
        )
        ->join('m_rps AS m', 'm.rps_id', '=', 'b.rps_id')
        ->leftJoin('d_rps_metode', 'b.bab_id', '=', 'd_rps_metode.bab_id')
        ->where('b.rps_id', '=', $rps_id)
        ->where('b.bab_id', '=', $bab_id)
        ->whereNull('m.deleted_at')
        ->first();
        // Log untuk memeriksa query dan hasilnya
    Log::info('getBabById query:', ['rps_id' => $rps_id, 'bab_id' => $bab_id, 'result' => $result]);

    return $result;
}
public static function getBabMateri($rps_id, $bab_id)
{
    $result= DB::table('d_rps_bab AS b')
        ->select('b.bab_id', 
        'b.rps_id', 
        'bm.judul_materi',
        'bm.file_url',
        )
        ->join('m_rps AS m', 'm.rps_id', '=', 'b.rps_id')
        ->leftJoin('d_rps_bab_materi as bm', 'b.bab_id', '=', 'bm.bab_id')
        ->where('b.rps_id', '=', $rps_id)
        ->where('b.bab_id', '=', $bab_id)
        ->whereNull('m.deleted_at')
        ->first();
        // Log untuk memeriksa query dan hasilnya
    Log::info('getBabById query:', ['rps_id' => $rps_id, 'bab_id' => $bab_id, 'result' => $result]);

    return $result;
}

}