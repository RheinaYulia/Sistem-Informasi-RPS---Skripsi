<?php

namespace App\Models\Rps;

use App\Models\AppModel;
use App\Models\KurikulumMKModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RpsModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'm_rps';
    protected $primaryKey = 'rps_id';

    protected static $_table = 'm_rps';
    protected static $_primaryKey = 'rps_id';

    protected $fillable = [
        'rps_id',
        'kaprodi_id',
        'kurikulum_mk_id',
        'deskripsi_rps',
        'tanggal_penyusunan',
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
    public function kurikulum()
    {
        return $this->belongsTo(KurikulumMKModel::class, 'kurikulum_mk_id', 'mk_id');
    }

    // Relasi dengan pengampu
    public function pengampu()
    {
        return $this->hasMany(PengampuModel::class, 'rps_id', 'rps_id');
    }

    public static function insertData($request, $exception = []){
        $exception = array_merge($exception, ['_token', '_method']);
        $data = $request->except($exception);
        $data['created_by'] = Auth::user()->user_id;
        $data['created_at'] = date('Y-m-d H:i:s');

        $id = self::insertGetId($data);
        $bab = array();
        for ($i = 1; $i <= 3; $i++) {
            $bab[$i] = [
                'rps_id' => $id,
                'rps_bab' => $i,
                'created_by' => Auth::user()->user_id,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }
        return RpsBabModel::insert($bab);
    }

    public static function getMkRps(){
        $map = DB::table('m_rps AS m')
            ->selectRaw('m.rps_id, m.deskripsi_rps,m.kurikulum_mk_id, m.kaprodi_id, k.mk_nama')
            ->join('d_kurikulum_mk AS p', function ($join) {
                $join->on('m.kurikulum_mk_id', '=', 'p.kurikulum_mk_id');
            })
            ->join('m_mk AS k', function ($join) {
                $join->on('p.mk_id', '=', 'k.mk_id');
            })
            ->whereNull('m.deleted_at')
            ->get();
        
        return $map;
    }

    public static function getDosenPengampu($rps_id){
        $map = DB::table('d_rps_pengampu AS m')
            ->selectRaw('m.rps_pengampu_id,m.rps_id,m.dosen_id,d.nama_dosen ')
            ->Join('m_rps AS gm', function ($join) use($rps_id){
                $join->on('gm.rps_id', '=', 'm.rps_id')
                    ->where('gm.rps_id', '=', $rps_id);
            })
            ->Join('d_dosen AS d', function ($join) {
                $join->on('d.rps_id', '=', 'm.rps_id');
            })->get();

            return $map;
        }

        public static function spInsertOrUpdateRPS($rps_id, array $jenis_media, array $nama_media, 
        array $dosen_pengampu_id, array $cpl_prodi_id, array $cpl_cpmk_id, array $mk_bk_id, array $dosen_pengembang_id,
        array $jenis_pustaka, array $referensi)
        {
            
            DB::beginTransaction();
            // print_r($jenis_media);
    
            try {
                // Log::info("Starting spInsertOrUpdateRPS with data: ", [
                //     'rps_id' => $rps_id,
                //     'jenis_media' => $jenis_media,
                //     'nama_media' => $nama_media,
                //     'dosen_pengampu_id' => $dosen_pengampu_id,
                //     'dosen_pengembang_id' => $dosen_pengembang_id
                // ]);

                // Ambil data yang sudah ada
                $existingMedia = DB::table('d_rps_media')
                ->where('rps_id', $rps_id)
                ->whereNull('deleted_at')
                ->get();
                $existingMediaIds = $existingMedia->pluck('rps_media_id')->toArray();

                foreach ($jenis_media as $index => $jenis) {
                    // Jika ID media sudah ada dalam data yang ada
                if (isset($existingMediaIds[$index])) {
                    $media = $existingMedia->where('rps_media_id', $existingMediaIds[$index])->first();

                    // Periksa apakah updated_at tidak null
                    if (is_null($media->deleted_at)) {
                        // Log::info("Updating media ID: {$existingMediaIds[$index]}, New Data: ", [
                        //     'jenis_media' => $jenis_media[$index],
                        //     'nama_media' => $nama_media[$index]
                        // ]);
                        DB::table('d_rps_media')
                            ->where('rps_id', $rps_id)
                            ->where('rps_media_id', $existingMediaIds[$index])
                            ->update([
                                'jenis_media' => $jenis_media[$index],
                                'nama_media' => $nama_media[$index],
                                'updated_at' => now() // Optional, jika ada kolom updated_at
                            ]);
                    } 
                }else {
                        // Jika ID media tidak ada dalam data yang ada, lakukan penambahan
                        DB::table('d_rps_media')->insert([
                            'rps_id' => $rps_id,
                            'jenis_media' => $jenis_media[$index],
                            'nama_media' => $nama_media[$index],
                            'created_at' => now(), // Optional, jika ada kolom created_at
                            'updated_at' => now() // Optional, jika ada kolom updated_at
                        ]);
                    }
                }

                 // Ambil data yang sudah ada d_rps_pustaka
                 $existingPustaka = DB::table('d_rps_pustaka')
                 ->where('rps_id', $rps_id)
                 ->whereNull('deleted_at')
                 ->get();
                 $existingPustakaIds = $existingPustaka->pluck('rps_pustaka_id')->toArray();
 
                 foreach ($jenis_pustaka as $index => $jenis) {
                     // Jika ID media sudah ada dalam data yang ada
                 if (isset($existingPustakaIds[$index])) {
                     $pustaka = $existingPustaka->where('rps_pustaka_id', $existingPustakaIds[$index])->first();
 
                     // Periksa apakah updated_at tidak null
                     if (is_null($pustaka->deleted_at)) {

                         DB::table('d_rps_pustaka')
                             ->where('rps_id', $rps_id)
                             ->where('rps_pustaka_id', $existingPustakaIds[$index])
                             ->update([
                                 'jenis_pustaka' => $jenis_pustaka[$index],
                                 'referensi' => $referensi[$index],
                                 'updated_at' => now() // Optional, jika ada kolom updated_at
                             ]);
                     } 
                 }else {
                         // Jika ID media tidak ada dalam data yang ada, lakukan penambahan
                         DB::table('d_rps_pustaka')->insert([
                             'rps_id' => $rps_id,
                             'jenis_pustaka' => $jenis_pustaka[$index],
                             'referensi' => $referensi[$index],
                             'created_at' => now(), // Optional, jika ada kolom created_at
                             'updated_at' => now() // Optional, jika ada kolom updated_at
                         ]);
                     }
                 }

    
                 // Insert or update d_rps_pengampu table
                 $existingPengampu = DB::table('d_rps_pengampu')
                    ->where('rps_id', $rps_id)
                    ->whereNull('deleted_at')
                    ->get();
                $existingPengampuIds = $existingPengampu->pluck('rps_pengampu_id')->toArray();

                foreach ($dosen_pengampu_id as $index => $jenis) {
                    // Jika ID media sudah ada dalam data yang ada
                if (isset($existingPengampuIds[$index])) {
                    $pengampuid = $existingPengampu->where('rps_pengampu_id', $existingPengampuIds[$index])->first();

                    // Periksa apakah updated_at tidak null
                    if (is_null($pengampuid->deleted_at)) {
                        DB::table('d_rps_pengampu')
                            ->where('rps_id', $rps_id)
                            ->where('rps_pengampu_id', $existingPengampuIds[$index])
                            ->update([
                                'dosen_id' => $dosen_pengampu_id[$index],
                                'updated_at' => now() // Optional, jika ada kolom updated_at
                            ]);
                    } 
                }else {
                        // Jika ID media tidak ada dalam data yang ada, lakukan penambahan
                        DB::table('d_rps_pengampu')->insert([
                            'rps_id' => $rps_id,
                            'dosen_id' => $dosen_pengampu_id[$index],
                            'created_at' => now(), // Optional, jika ada kolom created_at
                            'updated_at' => now() // Optional, jika ada kolom updated_at
                        ]);
                    }
                }

                        // Insert or update d_rps_cpl_prodi table
            $existingCPLProdi = DB::table('d_rps_cpl_prodi')
            ->where('rps_id', $rps_id)
            ->get();

            $existingCPLProdiIds = $existingCPLProdi->pluck('cpl_prodi_id')->toArray();

            foreach ($cpl_prodi_id as $index => $cplProdiId) {
            // Periksa apakah cpl_prodi_id sudah ada dalam data yang ada dengan deleted_at null
            $existing = $existingCPLProdi->where('cpl_prodi_id', $cplProdiId)
                                        ->whereNull('deleted_at')
                                        ->first();

            if (!$existing) {
                // Jika tidak ada data yang cocok dengan deleted_at null, tambahkan data baru
                DB::table('d_rps_cpl_prodi')->insert([
                    'rps_id' => $rps_id,
                    'cpl_prodi_id' => $cplProdiId,
                    'created_at' => now(), // Optional, jika ada kolom created_at
                    'updated_at' => now() // Optional, jika ada kolom updated_at
                ]);

                // Tambahkan log untuk setiap insert
                // Log::info('Inserted into d_rps_cpl_prodi', [
                //     'rps_id' => $rps_id,
                //     'cpl_prodi_id' => $cplProdiId,
                //     'timestamp' => now()
                // ]);
            }
            }


            // Insert or update d_rps_cpmk table
            $existingCplCpmk = DB::table('d_rps_cpmk')
                ->where('rps_id', $rps_id)
                ->whereNull('deleted_at')
                ->get();

            $existingCplCpmkIds = $existingCplCpmk->pluck('rps_cpmk_id')->toArray();

            foreach ($cpl_cpmk_id as $index => $cplCpmkId) {
                // Periksa apakah cpl_prodi_id sudah ada dalam data yang ada dengan deleted_at null
                $existingcpmk = $existingCplCpmk->where('cpl_cpmk_id', $cplCpmkId)
                                            ->whereNull('deleted_at')
                                            ->first();
    
                if (!$existingcpmk) {
                    // Jika tidak ada data yang cocok dengan deleted_at null, tambahkan data baru
                    DB::table('d_rps_cpmk')->insert([
                        'rps_id' => $rps_id,
                        'cpl_cpmk_id' => $cplCpmkId,
                        'created_at' => now(), // Optional, jika ada kolom created_at
                        'updated_at' => now() // Optional, jika ada kolom updated_at
                    ]);
                    
                }
                }

                // Insert or update d_rps_bk table
            $existingBK = DB::table('d_rps_bk')
            ->where('rps_id', $rps_id)
            ->whereNull('deleted_at')
            ->get();

            $existingCplCpmkIds = $existingBK->pluck('rps_bk_id')->toArray();

            foreach ($mk_bk_id as $index => $cplBkId) {
                // Periksa apakah cpl_prodi_id sudah ada dalam data yang ada dengan deleted_at null
                $existingbk = $existingBK->where('mk_bk_id', $cplBkId)
                                            ->whereNull('deleted_at')
                                            ->first();

            if (!$existingbk) {
                // Jika tidak ada data yang cocok dengan deleted_at null, tambahkan data baru
                DB::table('d_rps_bk')->insert([
                    'rps_id' => $rps_id,
                    'mk_bk_id' => $cplBkId,
                    'created_at' => now(), // Optional, jika ada kolom created_at
                    'updated_at' => now() // Optional, jika ada kolom updated_at
                ]);
                // Tambahkan log untuk setiap insert
                Log::info('Inserted into d_rps_bk', [
                    'rps_id' => $rps_id,
                    'mk_bk_id' => $cplBkId,
                    'timestamp' => now()
                ]);
                
            }
            }


            // Insert or update d_rps_pengembang table
            $existingPengembang = DB::table('d_rps_pengembang')
            ->where('rps_id', $rps_id)
            ->whereNull('deleted_at')
            ->get();
            $existingPengembangIds = $existingPengembang->pluck('rps_pengembang_id')->toArray();

            foreach ($dosen_pengembang_id as $index => $jenis) {
                // Jika ID media sudah ada dalam data yang ada
            if (isset($existingPengembangIds[$index])) {
                $pengembangid = $existingPengembang->where('rps_pengembang_id', $existingPengembangIds[$index])->first();

                // Periksa apakah updated_at tidak null
                if (is_null($pengembangid->deleted_at)) {
                    DB::table('d_rps_pengembang')
                        ->where('rps_id', $rps_id)
                        ->where('rps_pengembang_id', $existingPengembangIds[$index])
                        ->update([
                            'dosen_id' => $dosen_pengembang_id[$index],
                            'updated_at' => now() // Optional, jika ada kolom updated_at
                        ]);
                } 
            }else {
                    // Jika ID media tidak ada dalam data yang ada, lakukan penambahan
                    DB::table('d_rps_pengembang')->insert([
                        'rps_id' => $rps_id,
                        'dosen_id' => $dosen_pengembang_id[$index],
                        'created_at' => now(), // Optional, jika ada kolom created_at
                        'updated_at' => now() // Optional, jika ada kolom updated_at
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

public static function getRpsData($p_rps_id) {
    $rpsData = DB::table('m_rps')
                ->select('m_rps.*', 
                         'd_rps_pengembang.dosen_id as dosen_pengembang_id'
                )
                ->leftJoin('d_rps_pengembang', 'm_rps.rps_id', '=', 'd_rps_pengembang.rps_id')
                ->where('m_rps.rps_id', $p_rps_id)
                ->get();
    
    return $rpsData;
}

public static function getRpsMedia($p_rps_id) {
    // Ambil data media terkait RPS
    $mediaData = DB::table('d_rps_media')
                ->select('rps_media_id', 'jenis_media', 'nama_media')
                ->where('rps_id', $p_rps_id)
                ->whereNull('deleted_at')
                ->get();

    return $mediaData;
}

public static function getRpsPustaka($p_rps_id) {
    // Ambil data media terkait RPS
    $pustakaData = DB::table('d_rps_pustaka')
                ->select('rps_pustaka_id', 'jenis_pustaka', 'referensi')
                ->where('rps_id', $p_rps_id)
                ->whereNull('deleted_at')
                ->get();

    return $pustakaData;
}

public static function getRpsPengampu($p_rps_id) {
    // Ambil data media terkait RPS
    $mediaData = DB::table('d_rps_pengampu')
                ->select('dosen_id as dosen_pengampu_id','d_dosen.nama_dosen as dosen_pengampu')
                ->leftJoin('d_dosen', 'd_dosen.dosen_id', '=', 'd_rps_pengampu.dosen_id')
                ->where('rps_id', $p_rps_id)
                ->whereNull('deleted_at')
                ->get();

    return $mediaData;
}

public static function getRpsPengembang($p_rps_id) {
    // Ambil data media terkait RPS
    $mediaData = DB::table('d_rps_pengembang')
                ->select('dosen_id as dosen_pengembang_id')
                ->where('rps_id', $p_rps_id)
                ->whereNull('deleted_at')
                ->get();

    return $mediaData;
}

public static function getRpsDescription($p_rps_id) {
    $rpsDescription = DB::table('m_rps')
                        ->select('m_rps.rps_id','m_rps.kurikulum_mk_id','m_rps.deskripsi_rps',
                                    'm_rps.tanggal_penyusunan','m_mk.mk_nama',
                                     'd_kurikulum_mk.kode_mk','d_kurikulum_mk.mk_id',
                                    'd_kurikulum_mk.semester', 'd_kurikulum_mk.jumlah_jam', 'd_kurikulum_mk.sks',
                                    'm_rumpun_mk.rumpun_mk_id', 'm_rumpun_mk.rumpun_mk',)
                        ->leftJoin('d_kurikulum_mk', 'm_rps.kurikulum_mk_id', '=', 'd_kurikulum_mk.kurikulum_mk_id')
                        ->leftJoin('m_mk', 'd_kurikulum_mk.mk_id', '=', 'm_mk.mk_id')
                        ->leftJoin('m_rumpun_mk', 'd_kurikulum_mk.rumpun_mk_id', '=', 'm_rumpun_mk.rumpun_mk_id')
                        ->where('m_rps.rps_id', $p_rps_id)
                        ->first();
    
    return $rpsDescription;
}


public static function getCplProdi($p_rps_id) {
    $cplProdi = DB::table('m_prodi')
        ->select('m_cpl_prodi.cpl_prodi_id', 'm_cpl_prodi.cpl_prodi_kategori')
        ->join('d_kurikulum_mk', 'm_prodi.prodi_id', '=', 'd_kurikulum_mk.prodi_id')
        ->join('m_cpl_prodi', 'm_prodi.prodi_id', '=', 'm_cpl_prodi.prodi_id')
        ->join('m_rps', 'd_kurikulum_mk.kurikulum_mk_id', '=', 'm_rps.kurikulum_mk_id')
        ->where('m_rps.rps_id', $p_rps_id)
        ->groupBy('m_cpl_prodi.cpl_prodi_id', 'm_cpl_prodi.cpl_prodi_kategori')
        ->orderBy('m_cpl_prodi.cpl_prodi_id')
        ->get();

    return $cplProdi;
}


public static function getSelectedCplProdi($p_rps_id) {
    $selectedCplProdi = DB::table('d_rps_cpl_prodi')
        ->select('cpl_prodi_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
        ->where('rps_id', $p_rps_id)
        ->groupBy('cpl_prodi_id')
        ->get();

    return $selectedCplProdi;
}

public static function getCpmk($rps_id) {
    $cpmkKode = DB::table('t_cpl_cpmk')
        ->select('t_cpl_cpmk.cpl_cpmk_id', 'd_cpmk.cpmk_kode')
        ->join('m_cpl_prodi', 't_cpl_cpmk.cpl_prodi_id', '=', 'm_cpl_prodi.cpl_prodi_id')
        ->join('d_cpmk', 't_cpl_cpmk.cpmk_id', '=', 'd_cpmk.cpmk_id')
        ->join('d_kurikulum_mk', function($join) {
            $join->on('d_cpmk.mk_id', '=', 'd_kurikulum_mk.mk_id')
                 ->on('m_cpl_prodi.prodi_id', '=', 'd_kurikulum_mk.prodi_id');
        })
        ->join('m_rps', 'd_kurikulum_mk.kurikulum_mk_id', '=', 'm_rps.kurikulum_mk_id')
        ->where('m_rps.rps_id', $rps_id)
        ->groupBy('t_cpl_cpmk.cpl_cpmk_id', 'd_cpmk.cpmk_kode')
        ->orderBy('t_cpl_cpmk.cpl_cpmk_id')
        ->get();

    return $cpmkKode;
}

public static function getSelectedCpmk($rps_id) {
    $selectedCpmk = DB::table('d_rps_cpmk')
        ->select('cpl_cpmk_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
        ->where('rps_id', $rps_id)
        ->groupBy('cpl_cpmk_id')
        ->get();

    return $selectedCpmk;
}



public static function getBk($rps_id) {
    $bkKode = DB::table('t_mk_bk')
        ->select('t_mk_bk.mk_bk_id', 'm_bahan_kajian.bk_deskripsi')
        ->join('m_bahan_kajian', 't_mk_bk.bk_id', '=', 'm_bahan_kajian.bk_id')
        ->join('m_prodi', 'm_bahan_kajian.prodi_id', '=', 'm_prodi.prodi_id')
        ->join('m_mk', 't_mk_bk.mk_id', '=', 'm_mk.mk_id')
        ->join('d_kurikulum_mk', function($join) {
            $join->on('m_mk.mk_id', '=', 'd_kurikulum_mk.mk_id')
                 ->on('m_bahan_kajian.prodi_id', '=', 'd_kurikulum_mk.prodi_id');
        })
        ->join('m_rps', 'd_kurikulum_mk.kurikulum_mk_id', '=', 'm_rps.kurikulum_mk_id')
        ->where('m_rps.rps_id', $rps_id)
        ->groupBy('t_mk_bk.mk_bk_id', 'm_bahan_kajian.bk_deskripsi')
        ->orderBy('t_mk_bk.mk_bk_id')
        ->get();

    return $bkKode;
}

public static function getSelectedBk($rps_id) {
    $selectedBk = DB::table('d_rps_bk')
        ->select('mk_bk_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
        ->where('rps_id', $rps_id)
        ->groupBy('mk_bk_id')
        ->get();

    return $selectedBk;
}


    
    
}
