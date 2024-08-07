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
        'keterangan_rps',
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
    
        DB::beginTransaction();
        try {
            // Insert ke tabel utama dan dapatkan ID yang baru dibuat
            $id = self::insertGetId($data);
            Log::info('Inserted main record with ID: ' . $id);
    
            // Insert ke tabel RpsBabModel
            $bab = array();
            for ($i = 1; $i <= 17; $i++) {
                $bab[$i] = [
                    'rps_id' => $id,
                    'rps_bab' => $i,
                    'created_by' => Auth::user()->user_id,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            }
            RpsBabModel::insert($bab);
            Log::info('Inserted RpsBab records');
    
            // Dapatkan kakel_mk_id dari t_kakel_mk berdasarkan kurikulum_mk_id
            $kakelMkIds = DB::table('t_kakel_mk')
                ->where('kurikulum_mk_id', $data['kurikulum_mk_id'])
                ->pluck('kakel_mk_id');
    
            // Log hasil query untuk debugging
            Log::info('KakelMkIds: ' . $kakelMkIds);
    
            // Jika ada kecocokan, insert ke d_rps_kakel
            if ($kakelMkIds->isNotEmpty()) {
                $dRpsKakelData = [];
                foreach ($kakelMkIds as $kakelMkId) {
                    $dRpsKakelData[] = [
                        'rps_id' => $id,
                        'kakel_mk_id' => $kakelMkId,
                        'created_by' => Auth::user()->user_id,
                        'created_at' => date('Y-m-d H:i:s'),
                    ];
                }
                DB::table('d_rps_kakel')->insert($dRpsKakelData);
                Log::info('Inserted d_rps_kakel records: ' . json_encode($dRpsKakelData));
            } else {
                Log::info('No matching records found in t_kakel_mk');
            }
    
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error: ' . $e->getMessage());
            throw $e;
        }
    }
    

    public static function getMkRps($userId){
        $periode = session('periode');
    
    if (!$periode || !isset($periode->periode_id)) {
        // Handle the case where periode is not set in session
        return collect();
    }

    $selectedPeriodeId = $periode->periode_id;

    $map = DB::table('m_rps AS m')
        ->selectRaw('m.rps_id, m.deskripsi_rps, m.kurikulum_mk_id, m.kaprodi_id, k.mk_nama, ds.nama_dosen, m.verifikasi, m.pengesahan')
        ->join('d_kurikulum_mk AS p', function ($join) {
            $join->on('m.kurikulum_mk_id', '=', 'p.kurikulum_mk_id');
        })
        ->join('m_mk AS k', function ($join) {
            $join->on('p.mk_id', '=', 'k.mk_id');
        })
        ->join('d_kaprodi AS d', function ($join) {
            $join->on('m.kaprodi_id', '=', 'd.kaprodi_id');
        })
        ->join('d_dosen AS ds', function ($join) {
            $join->on('d.dosen_id', '=', 'ds.dosen_id');
        })
        ->leftJoin('d_rps_pengembang AS rp', function ($join) {
            $join->on('m.rps_id', '=', 'rp.rps_id');
        })
        ->leftJoin('d_rps_pengampu AS ra', function ($join) {
            $join->on('m.rps_id', '=', 'ra.rps_id');
        })
        ->leftJoin('d_dosen AS dp_pengembang', function ($join) {
            $join->on('rp.dosen_id', '=', 'dp_pengembang.dosen_id');
        })
        ->leftJoin('s_user AS su_pengembang', 'dp_pengembang.user_id', '=', 'su_pengembang.user_id')
        ->join('m_periode AS pr', 'p.periode_id', '=', 'pr.periode_id') // Join dengan tabel m_periode
        ->where('pr.periode_id', $selectedPeriodeId) // Filter berdasarkan periode yang dipilih
        ->where(function ($query) use ($userId) {
            $query->where('su_pengembang.user_id', $userId)
                  ->whereNull('rp.deleted_at')
                  ->orWhere('m.created_by', $userId)
                  ->orWhereRaw('? = 1', [$userId]);
        })
        ->whereNull('m.deleted_at')
        ->groupBy('m.rps_id')
        ->get();
    
    return $map;
    }
    
    public static function getRps($userId){
        $map = DB::table('m_rps AS m')
            ->selectRaw('m.rps_id, m.deskripsi_rps, m.kurikulum_mk_id, m.kaprodi_id, k.mk_nama, ds.nama_dosen')
            ->join('d_kurikulum_mk AS p', function ($join) {
                $join->on('m.kurikulum_mk_id', '=', 'p.kurikulum_mk_id');
            })
            ->join('m_mk AS k', function ($join) {
                $join->on('p.mk_id', '=', 'k.mk_id');
            })
            ->join('d_kaprodi AS d', function ($join) {
                $join->on('m.kaprodi_id', '=', 'd.kaprodi_id');
            })
            ->join('d_dosen AS ds', function ($join) {
                $join->on('d.dosen_id', '=', 'ds.dosen_id');
            })
            ->leftJoin('d_rps_pengembang AS rp', function ($join) {
                $join->on('m.rps_id', '=', 'rp.rps_id');
            })
            ->leftJoin('d_rps_pengampu AS ra', function ($join) {
                $join->on('m.rps_id', '=', 'ra.rps_id');
            })
            ->leftJoin('d_dosen AS dp_pengembang', function ($join) {
                $join->on('rp.dosen_id', '=', 'dp_pengembang.dosen_id');
            })
            ->leftJoin('d_dosen AS dp_pengampu', function ($join) {
                $join->on('ra.dosen_id', '=', 'dp_pengampu.dosen_id');
            })
            ->leftJoin('s_user AS su_pengembang', 'dp_pengembang.user_id', '=', 'su_pengembang.user_id')
            ->leftJoin('s_user AS su_pengampu', 'dp_pengampu.user_id', '=', 'su_pengampu.user_id')
            ->where(function ($query) use ($userId) {
                $query->where('su_pengembang.user_id', $userId)
                        ->whereNull('rp.deleted_at')
                      ->orWhere('su_pengampu.user_id', $userId)
                      ->whereNull('ra.deleted_at')
                      ->orWhere('m.created_by', $userId)
                      ->orWhereRaw('? = 1', [$userId]);
            })
            ->where('m.pengesahan',1)
            ->whereNull('m.deleted_at')
            ->groupBy('m.rps_id')
            ->get();
        
        return $map;
    }
    
    

    public static function getRpsDelete($id)
{
    $data = DB::table('m_rps AS m')
        ->select('m.rps_id', 'm.deskripsi_rps', 'm.kurikulum_mk_id', 'm.kaprodi_id', 'k.mk_nama', 'ds.nama_dosen','m.tanggal_penyusunan')
        ->join('d_kurikulum_mk AS p', 'm.kurikulum_mk_id', '=', 'p.kurikulum_mk_id')
        ->join('m_mk AS k', 'p.mk_id', '=', 'k.mk_id')
        ->join('d_kaprodi AS d', 'm.kaprodi_id', '=', 'd.kaprodi_id')
        ->join('d_dosen AS ds', 'd.dosen_id', '=', 'ds.dosen_id')
        ->where('m.rps_id', $id)
        ->whereNull('m.deleted_at')
        ->first(); // Use first() to get a single row
        
    return $data;
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

        public static function spPengembang($rps_id, array $dosen_pengembang_id = null)
{
    DB::beginTransaction();

    try {
        // Jika array $dosen_pengembang_id kosong, hapus semua data yang ada
        if (empty($dosen_pengembang_id)) {
            DB::table('d_rps_pengembang')
                ->where('rps_id', $rps_id)
                ->update(['deleted_at' => now()]);
        } else {
            // Ambil data pengembang yang ada
            $existingPengembang = DB::table('d_rps_pengembang')
                ->where('rps_id', $rps_id)
                ->whereNull('deleted_at')
                ->get();
            $existingPengembangIds = $existingPengembang->pluck('rps_pengembang_id')->toArray();

            foreach ($dosen_pengembang_id as $index => $jenis) {
                if (isset($existingPengembangIds[$index])) {
                    $pengembangid = $existingPengembang->where('rps_pengembang_id', $existingPengembangIds[$index])->first();

                    if (is_null($pengembangid->deleted_at)) {
                        DB::table('d_rps_pengembang')
                            ->where('rps_id', $rps_id)
                            ->where('rps_pengembang_id', $existingPengembangIds[$index])
                            ->update([
                                'dosen_id' => $dosen_pengembang_id[$index],
                                'updated_at' => now()
                            ]);
                    }
                } else {
                    DB::table('d_rps_pengembang')->insert([
                        'rps_id' => $rps_id,
                        'dosen_id' => $dosen_pengembang_id[$index],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollback();
        return false;
    }
}

public static function spPengampu($rps_id, array $dosen_pengampu_id = null)
{
    DB::beginTransaction();

    try {
        // Jika array $dosen_pengampu_id kosong, hapus semua data yang ada
        if (empty($dosen_pengampu_id)) {
            DB::table('d_rps_pengampu')
                ->where('rps_id', $rps_id)
                ->update(['deleted_at' => now()]);
        } else {
            // Ambil data pengampu yang ada
            $existingPengampu = DB::table('d_rps_pengampu')
                ->where('rps_id', $rps_id)
                ->whereNull('deleted_at')
                ->get();
            $existingPengampuIds = $existingPengampu->pluck('rps_pengampu_id')->toArray();

            foreach ($dosen_pengampu_id as $index => $jenis) {
                if (isset($existingPengampuIds[$index])) {
                    $pengampuid = $existingPengampu->where('rps_pengampu_id', $existingPengampuIds[$index])->first();

                    if (is_null($pengampuid->deleted_at)) {
                        DB::table('d_rps_pengampu')
                            ->where('rps_id', $rps_id)
                            ->where('rps_pengampu_id', $existingPengampuIds[$index])
                            ->update([
                                'dosen_id' => $dosen_pengampu_id[$index],
                                'updated_at' => now()
                            ]);
                    }
                } else {
                    DB::table('d_rps_pengampu')->insert([
                        'rps_id' => $rps_id,
                        'dosen_id' => $dosen_pengampu_id[$index],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollback();
        return false;
    }
}


public static function spCplProdi($rps_id, array $cpl_prodi_id = null)
{
    DB::beginTransaction();

    try {
        if (empty($cpl_prodi_id)) {
            DB::table('d_rps_cpl_prodi')
                ->where('rps_id', $rps_id)
                ->update(['deleted_at' => now()]);
        } else {
            $existingCPLProdi = DB::table('d_rps_cpl_prodi')
                ->where('rps_id', $rps_id)
                ->get();

            $existingCPLProdiIds = $existingCPLProdi->pluck('cpl_prodi_id')->toArray();

            foreach ($cpl_prodi_id as $index => $cplProdiId) {
                $existing = $existingCPLProdi->where('cpl_prodi_id', $cplProdiId)
                                            ->whereNull('deleted_at')
                                            ->first();

                if (!$existing) {
                    DB::table('d_rps_cpl_prodi')->insert([
                        'rps_id' => $rps_id,
                        'cpl_prodi_id' => $cplProdiId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollback();
        return false;
    }
}

public static function spCPMK($rps_id, array $cpl_cpmk_id = null)
{
    DB::beginTransaction();

    try {
        if (empty($cpl_cpmk_id)) {
            DB::table('d_rps_cpmk')
                ->where('rps_id', $rps_id)
                ->update(['deleted_at' => now()]);
        } else {
            $existingCplCpmk = DB::table('d_rps_cpmk')
                ->where('rps_id', $rps_id)
                ->whereNull('deleted_at')
                ->get();

            $existingCplCpmkIds = $existingCplCpmk->pluck('rps_cpmk_id')->toArray();

            foreach ($cpl_cpmk_id as $index => $cplCpmkId) {
                $existingcpmk = $existingCplCpmk->where('cpl_cpmk_id', $cplCpmkId)
                                                ->whereNull('deleted_at')
                                                ->first();

                if (!$existingcpmk) {
                    DB::table('d_rps_cpmk')->insert([
                        'rps_id' => $rps_id,
                        'cpl_cpmk_id' => $cplCpmkId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollback();
        return false;
    }
}

public static function spBk($rps_id, array $mk_bk_id = null)
{
    DB::beginTransaction();

    try {
        if (empty($mk_bk_id)) {
            DB::table('d_rps_bk')
                ->where('rps_id', $rps_id)
                ->update(['deleted_at' => now()]);
        } else {
            $existingBK = DB::table('d_rps_bk')
                ->where('rps_id', $rps_id)
                ->whereNull('deleted_at')
                ->get();

            $existingBkIds = $existingBK->pluck('rps_bk_id')->toArray();

            foreach ($mk_bk_id as $index => $cplBkId) {
                $existingbk = $existingBK->where('mk_bk_id', $cplBkId)
                                        ->whereNull('deleted_at')
                                        ->first();

                if (!$existingbk) {
                    DB::table('d_rps_bk')->insert([
                        'rps_id' => $rps_id,
                        'mk_bk_id' => $cplBkId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollback();
        return false;
    }
}

public static function spMkSyarat($rps_id, array $kurikulum_mk_id = null)
{
    DB::beginTransaction();

    try {
        if (empty($kurikulum_mk_id)) {
            DB::table('d_rps_mk_syarat')
                ->where('rps_id', $rps_id)
                ->update(['deleted_at' => now()]);
        } else {
            $existingBK = DB::table('d_rps_mk_syarat')
                ->where('rps_id', $rps_id)
                ->whereNull('deleted_at')
                ->get();

            $existingBkIds = $existingBK->pluck('rps_mk_syarat_id')->toArray();

            foreach ($kurikulum_mk_id as $index => $kurikulumid) {
                $existingbk = $existingBK->where('kurikulum_mk_id', $kurikulumid)
                                        ->whereNull('deleted_at')
                                        ->first();

                if (!$existingbk) {
                    DB::table('d_rps_mk_syarat')->insert([
                        'rps_id' => $rps_id,
                        'kurikulum_mk_id' => $kurikulumid,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollback();
        return false;
    }
}



        public static function spMedia($rps_id, array $media_id)
        {
            
            DB::beginTransaction();
            // print_r($jenis_media);
    
            try {

                // Insert or update d_rps_pengembang table
            $existingPengembang = DB::table('d_rps_media')
            ->where('rps_id', $rps_id)
            ->whereNull('deleted_at')
            ->get();
            $existingPengembangIds = $existingPengembang->pluck('rps_media_id')->toArray();

            foreach ($media_id as $index => $jenis) {
                // Jika ID media sudah ada dalam data yang ada
            if (isset($existingPengembangIds[$index])) {
                $pengembangid = $existingPengembang->where('rps_media_id', $existingPengembangIds[$index])->first();

                // Periksa apakah updated_at tidak null
                if (is_null($pengembangid->deleted_at)) {
                    DB::table('d_rps_media')
                        ->where('rps_id', $rps_id)
                        ->where('rps_media_id', $existingPengembangIds[$index])
                        ->update([
                            'media_id' => $media_id[$index],
                            'updated_at' => now() // Optional, jika ada kolom updated_at
                        ]);
                } 
            }else {
                    // Jika ID media tidak ada dalam data yang ada, lakukan penambahan
                    DB::table('d_rps_media')->insert([
                        'rps_id' => $rps_id,
                        'media_id' => $media_id[$index],
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


        public static function spPustaka($rps_id, array $pustaka_id,
       )
        {
            
            DB::beginTransaction();
            // print_r($jenis_media);
    
            try {

                // Insert or update d_rps_pengembang table
            $existingPengembang = DB::table('d_rps_pustaka')
            ->where('rps_id', $rps_id)
            ->whereNull('deleted_at')
            ->get();
            $existingPengembangIds = $existingPengembang->pluck('rps_pustaka_id')->toArray();

            foreach ($pustaka_id as $index => $jenis) {
                // Jika ID media sudah ada dalam data yang ada
            if (isset($existingPengembangIds[$index])) {
                $pengembangid = $existingPengembang->where('rps_pustaka_id', $existingPengembangIds[$index])->first();

                // Periksa apakah updated_at tidak null
                if (is_null($pengembangid->deleted_at)) {
                    DB::table('d_rps_pustaka')
                        ->where('rps_id', $rps_id)
                        ->where('rps_pustaka_id', $existingPengembangIds[$index])
                        ->update([
                            'pustaka_id' => $pustaka_id[$index],
                            'updated_at' => now() // Optional, jika ada kolom updated_at
                        ]);
                } 
            }else {
                    // Jika ID media tidak ada dalam data yang ada, lakukan penambahan
                    DB::table('d_rps_pustaka')->insert([
                        'rps_id' => $rps_id,
                        'pustaka_id' => $pustaka_id[$index],
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
                ->select('d_rps_media.rps_media_id as rps_media_id','d_rps_media.media_id as media_id','d_media.nama_media as nama_media','d_media.jenis_media as jenis_media')
                ->leftJoin('d_media', 'd_media.media_id', '=', 'd_rps_media.media_id')
                ->where('d_rps_media.rps_id', $p_rps_id)
                ->whereNull('d_rps_media.deleted_at')
                ->get();

    return $mediaData;
}

public static function getRpsPustaka($p_rps_id) {
    // Ambil data media terkait RPS
    $pustakaData = DB::table('d_rps_pustaka')
                ->select('d_rps_pustaka.rps_pustaka_id as rps_pustaka_id','d_rps_pustaka.pustaka_id as pustaka_id','d_pustaka.referensi as referensi','d_pustaka.jenis_pustaka as jenis_pustaka')
                ->leftJoin('d_pustaka', 'd_pustaka.pustaka_id', '=', 'd_rps_pustaka.pustaka_id')
                ->where('d_rps_pustaka.rps_id', $p_rps_id)
                ->whereNull('d_rps_pustaka.deleted_at')
                ->get();

    return $pustakaData;
}

public static function getRpsPengampu($p_rps_id) {
    // Ambil data media terkait RPS
    $mediaData = DB::table('d_rps_pengampu')
                ->select('dosen_id as dosen_pengampu_id')
                ->where('rps_id', $p_rps_id)
                ->whereNull('deleted_at')
                ->get();

    return $mediaData;
}

public static function getRpsPengampuView($p_rps_id) {
    // Ambil data media terkait RPS
    $mediaData = DB::table('d_rps_pengampu')
                ->select('d_rps_pengampu.dosen_id','d_dosen.dosen_id as dosen_id','d_dosen.nama_dosen as nama_dosen')
                ->leftJoin('d_dosen', 'd_dosen.dosen_id', '=', 'd_rps_pengampu.dosen_id')
                ->where('d_rps_pengampu.rps_id', $p_rps_id)
                ->whereNull('d_rps_pengampu.deleted_at')
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

public static function getPengembang($p_rps_id) {
    // Ambil data media terkait RPS
    $mediaData = DB::table('d_rps_pengembang')
                ->select('d_rps_pengembang.dosen_id', 'd_dosen.nama_dosen')
                ->leftJoin('d_dosen', 'd_dosen.dosen_id', '=', 'd_rps_pengembang.dosen_id')
                ->where('d_rps_pengembang.rps_id', $p_rps_id)
                ->whereNull('d_rps_pengembang.deleted_at')
                ->get();

    return $mediaData;
}

public static function getRpsDescription($p_rps_id) {
    $rpsDescription = DB::table('m_rps')
                        ->select('m_rps.rps_id','m_rps.kurikulum_mk_id','m_rps.deskripsi_rps',
                                    'm_rps.tanggal_penyusunan','m_mk.mk_nama',
                                     'd_kurikulum_mk.kode_mk','d_kurikulum_mk.mk_id',
                                    'd_kurikulum_mk.semester', 'd_kurikulum_mk.jumlah_jam', 'd_kurikulum_mk.sks',
                                    'm_rumpun_mk.rumpun_mk_id', 'm_rumpun_mk.rumpun_mk',
                                    'd_kaprodi.kaprodi_id', 'd_dosen.dosen_id', 'd_dosen.nama_dosen',
                                    'm_prodi.prodi_id', 'm_prodi.nama_prodi',
                                    'm_rps.keterangan_rps',
                                    'd_dosen_rumpun.dosen_id as dosen_rumpun_id', 'd_dosen_rumpun.nama_dosen as koordinator',)
                        ->leftJoin('d_kurikulum_mk', 'm_rps.kurikulum_mk_id', '=', 'd_kurikulum_mk.kurikulum_mk_id')
                        ->leftJoin('m_mk', 'd_kurikulum_mk.mk_id', '=', 'm_mk.mk_id')
                        ->leftJoin('m_rumpun_mk', 'd_kurikulum_mk.rumpun_mk_id', '=', 'm_rumpun_mk.rumpun_mk_id')
                        ->leftJoin('d_kaprodi', 'm_rps.kaprodi_id', '=', 'd_kaprodi.kaprodi_id')
                        ->leftJoin('d_dosen', 'd_kaprodi.dosen_id', '=', 'd_dosen.dosen_id')
                        ->leftJoin('d_dosen as d_dosen_rumpun', 'd_kurikulum_mk.rumpun_mk_id', '=', 'd_dosen_rumpun.dosen_id')
                        ->leftJoin('m_prodi', 'd_kaprodi.prodi_id', '=', 'm_prodi.prodi_id')
                        ->where('m_rps.rps_id', $p_rps_id)
                        ->first();
    
    return $rpsDescription;
}


public static function getCplProdi($p_rps_id) {
    $cplProdi = DB::table('m_prodi')
        ->select('m_cpl_prodi.cpl_prodi_id', 'm_cpl_prodi.cpl_prodi_kode','m_cpl_prodi.cpl_prodi_deskripsi')
        ->join('d_kurikulum_mk', 'm_prodi.prodi_id', '=', 'd_kurikulum_mk.prodi_id')
        ->join('m_cpl_prodi', 'm_prodi.prodi_id', '=', 'm_cpl_prodi.prodi_id')
        ->join('m_rps', 'd_kurikulum_mk.kurikulum_mk_id', '=', 'm_rps.kurikulum_mk_id')
        ->where('m_rps.rps_id', $p_rps_id)
        ->groupBy('m_cpl_prodi.cpl_prodi_id', 'm_cpl_prodi.cpl_prodi_deskripsi')
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

public static function getRpsMkSyarat($p_rps_id) {
    $rpsDescription = DB::table('d_kurikulum_mk')
                        ->select('d_kurikulum_mk.kurikulum_mk_id','m_mk.mk_nama',
                                     'd_kurikulum_mk.kode_mk','d_kurikulum_mk.mk_id',
                                    'd_kurikulum_mk.semester', 'd_kurikulum_mk.jumlah_jam', 'd_kurikulum_mk.sks'
                                    )
                        ->leftJoin('m_mk', 'd_kurikulum_mk.mk_id', '=', 'm_mk.mk_id')
                        ->get();
    
    return $rpsDescription;
}

public static function getSelectedMkSyarat($p_rps_id) {
    $selectedCplProdi = DB::table('d_rps_mk_syarat')
        ->select('kurikulum_mk_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
        ->where('rps_id', $p_rps_id)
        ->groupBy('kurikulum_mk_id')
        ->get();

    return $selectedCplProdi;
}

public static function getRpsMkView($p_rps_id) {
    // Ambil data media terkait RPS
    $mediaData = DB::table('d_rps_mk_syarat')
                ->leftJoin('d_kurikulum_mk', 'd_rps_mk_syarat.kurikulum_mk_id', '=', 'd_kurikulum_mk.kurikulum_mk_id')
                ->leftJoin('m_mk', 'd_kurikulum_mk.mk_id', '=', 'm_mk.mk_id')
                ->select('d_rps_mk_syarat.kurikulum_mk_id', 'd_kurikulum_mk.mk_id', 'm_mk.mk_nama', 'd_kurikulum_mk.kode_mk')
                ->where('d_rps_mk_syarat.rps_id', $p_rps_id)
                ->whereNull('d_rps_mk_syarat.deleted_at')
                ->get();

    return $mediaData;
}


public static function getCplProdiview($p_rps_id) {
    $cplProdi = DB::table('m_prodi')
        ->select('m_cpl_prodi.cpl_prodi_id', 'd_rps_cpl_prodi.cpl_prodi_id', 'm_cpl_prodi.cpl_prodi_kode','m_cpl_prodi.cpl_prodi_deskripsi')
        ->join('d_kurikulum_mk', 'm_prodi.prodi_id', '=', 'd_kurikulum_mk.prodi_id')
        ->join('m_cpl_prodi', 'm_prodi.prodi_id', '=', 'm_cpl_prodi.prodi_id')
        ->join('m_rps', 'd_kurikulum_mk.kurikulum_mk_id', '=', 'm_rps.kurikulum_mk_id')
        ->join('d_rps_cpl_prodi', 'm_cpl_prodi.cpl_prodi_id', '=', 'd_rps_cpl_prodi.cpl_prodi_id')
        ->where('m_rps.rps_id', $p_rps_id)
        ->whereNull('d_rps_cpl_prodi.deleted_at')
        ->groupBy('m_cpl_prodi.cpl_prodi_id', 'm_cpl_prodi.cpl_prodi_deskripsi')
        ->orderBy('m_cpl_prodi.cpl_prodi_id')
        ->get();

    return $cplProdi;
}

public static function getCpmk($rps_id) {
    $cpmkKode = DB::table('t_cpl_cpmk')
        ->select('t_cpl_cpmk.cpl_cpmk_id', 'd_cpmk.cpmk_kode', 'd_cpmk.cpmk_deskripsi')
        ->join('m_cpl_prodi', 't_cpl_cpmk.cpl_prodi_id', '=', 'm_cpl_prodi.cpl_prodi_id')
        ->join('d_cpmk', 't_cpl_cpmk.cpmk_id', '=', 'd_cpmk.cpmk_id')
        ->join('d_rps_cpl_prodi', function($join) use ($rps_id) {
            $join->on('m_cpl_prodi.cpl_prodi_id', '=', 'd_rps_cpl_prodi.cpl_prodi_id')
                 ->where('d_rps_cpl_prodi.rps_id', '=', $rps_id)
                 ->whereNull('d_rps_cpl_prodi.deleted_at');
        })
        ->where('d_rps_cpl_prodi.rps_id', $rps_id)
        ->groupBy('t_cpl_cpmk.cpl_cpmk_id', 'd_cpmk.cpmk_kode')
        ->orderBy('t_cpl_cpmk.cpl_cpmk_id')
        ->get();

    return $cpmkKode;
}

public static function getCpmkView($rps_id) {
    $cpmkKode = DB::table('t_cpl_cpmk')
        ->select('t_cpl_cpmk.cpl_cpmk_id','d_rps_cpmk.cpl_cpmk_id', 'd_cpmk.cpmk_kode', 'd_cpmk.cpmk_deskripsi')
        ->join('m_cpl_prodi', 't_cpl_cpmk.cpl_prodi_id', '=', 'm_cpl_prodi.cpl_prodi_id')
        ->join('d_cpmk', 't_cpl_cpmk.cpmk_id', '=', 'd_cpmk.cpmk_id')
        ->join('d_rps_cpl_prodi', function($join) use ($rps_id) {
            $join->on('m_cpl_prodi.cpl_prodi_id', '=', 'd_rps_cpl_prodi.cpl_prodi_id')
                 ->where('d_rps_cpl_prodi.rps_id', '=', $rps_id)
                 ->whereNull('d_rps_cpl_prodi.deleted_at');
        })
        ->join('d_rps_cpmk', 't_cpl_cpmk.cpl_cpmk_id', '=', 'd_rps_cpmk.cpl_cpmk_id')
        ->where('d_rps_cpl_prodi.rps_id', $rps_id)
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

public static function getSelectedPengembang($rps_id) {
    $selectedCpmk = DB::table('d_rps_pengembang')
        ->select('dosen_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
        ->where('rps_id', $rps_id)
        ->groupBy('dosen_id')
        ->get();

    return $selectedCpmk;
}

public static function getSelectedPengampu($rps_id) {
    $selectedCpmk = DB::table('d_rps_pengampu')
        ->select('dosen_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
        ->where('rps_id', $rps_id)
        ->groupBy('dosen_id')
        ->get();

    return $selectedCpmk;
}

public static function getViewttc($rps_id) {
    $rpsDetails = DB::table('m_rps')
                    ->select('m_rps.rps_id', 'd_dosen.dosen_id', 'd_rps_pengampu.dosen_id as dosen_pengampu_id', 'd_rps_pengembang.dosen_id as dosen_pengembang_id', 'd_dosen.nama_dosen')
                    ->leftJoin('d_rps_pengampu', 'm_rps.rps_id', '=', 'd_rps_pengampu.rps_id')
                    ->leftJoin('d_rps_pengembang', 'm_rps.rps_id', '=', 'd_rps_pengembang.rps_id')
                    ->leftJoin('d_dosen', function($join) {
                        $join->on('d_rps_pengampu.dosen_id', '=', 'd_dosen.dosen_id')
                             ->orOn('d_rps_pengembang.dosen_id', '=', 'd_dosen.dosen_id');
                    })
                    ->where('m_rps.rps_id', $rps_id)
                    ->get();

    return $rpsDetails;
}




public static function getBk($rps_id) {
    $bkKode = DB::table('t_mk_bk')
        ->select('t_mk_bk.mk_bk_id', 'm_bahan_kajian.bk_deskripsi','m_bahan_kajian.bk_kode')
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

public static function getBkView($rps_id) {
    $bkKode = DB::table('t_mk_bk')
        ->select('t_mk_bk.mk_bk_id','d_rps_bk.mk_bk_id', 'm_bahan_kajian.bk_deskripsi','m_bahan_kajian.bk_kode')
        ->join('m_bahan_kajian', 't_mk_bk.bk_id', '=', 'm_bahan_kajian.bk_id')
        ->join('m_prodi', 'm_bahan_kajian.prodi_id', '=', 'm_prodi.prodi_id')
        ->join('m_mk', 't_mk_bk.mk_id', '=', 'm_mk.mk_id')
        ->join('d_kurikulum_mk', function($join) {
            $join->on('m_mk.mk_id', '=', 'd_kurikulum_mk.mk_id')
                 ->on('m_bahan_kajian.prodi_id', '=', 'd_kurikulum_mk.prodi_id');
        })
        ->join('m_rps', 'd_kurikulum_mk.kurikulum_mk_id', '=', 'm_rps.kurikulum_mk_id')
        ->join('d_rps_bk', function($join) use ($rps_id) {
            $join->on('t_mk_bk.mk_bk_id', '=', 'd_rps_bk.mk_bk_id')
                 ->where('d_rps_bk.rps_id', '=', $rps_id)
                 ->whereNull('d_rps_bk.deleted_at');
        })
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


//KAKEL
public static function getSelectedkakel1($rps_id) {
    $selectedCpmk = DB::table('d_rps_kakel')
        ->select('dosen_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
        ->where('rps_id', $rps_id)
        ->groupBy('dosen_id')
        ->get();

    return $selectedCpmk;
}

public static function spkakel1($rps_id, array $dosen_id = null)
{
    DB::beginTransaction();

    try {
        // Jika array $dosen_pengembang_id kosong, hapus semua data yang ada
        if (empty($dosen_id)) {
            DB::table('d_rps_kakel')
                ->where('rps_id', $rps_id)
                ->update(['deleted_at' => now()]);
        } else {
            // Ambil data pengembang yang ada
            $existingPengembang = DB::table('d_rps_kakel')
                ->where('rps_id', $rps_id)
                ->whereNull('deleted_at')
                ->get();
            $existingPengembangIds = $existingPengembang->pluck('rps_kakel_id')->toArray();

            foreach ($dosen_id as $index => $jenis) {
                if (isset($existingPengembangIds[$index])) {
                    $pengembangid = $existingPengembang->where('rps_kakel_id', $existingPengembangIds[$index])->first();

                    if (is_null($pengembangid->deleted_at)) {
                        DB::table('d_rps_kakel')
                            ->where('rps_id', $rps_id)
                            ->where('rps_kakel_id', $existingPengembangIds[$index])
                            ->update([
                                'dosen_id' => $dosen_id[$index],
                                'updated_at' => now()
                            ]);
                    }
                } else {
                    DB::table('d_rps_kakel')->insert([
                        'rps_id' => $rps_id,
                        'dosen_id' => $dosen_id[$index],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollback();
        return false;
    }
}

// Mendapatkan dosen yang is_kakelnya bernilai 1
public static function getIsKakel1()
    {
        return DB::table('d_dosen')
            ->select('d_dosen.dosen_id', 'd_dosen.nama_dosen', 'd_kakel.is_kakel', 'd_kakel.kakel_id')
            ->leftJoin('d_kakel', 'd_dosen.dosen_id', '=', 'd_kakel.dosen_id')
            ->where('d_kakel.is_kakel', 1)
            ->get();
    }

   public static function getSelectedKakel2($rps_id) {
    return DB::table('d_rps_kakels')
        ->select('kakel_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
        ->where('rps_id', $rps_id)
        ->groupBy('kakel_id')
        ->get();
}

public static function spKakel2($rps_id, array $kakel_ids = null)
{
    DB::beginTransaction();

    try {
        // Jika array $kakel_ids kosong, hapus semua data yang ada
        if (empty($kakel_ids)) {
            DB::table('d_rps_kakels')
                ->where('rps_id', $rps_id)
                ->update(['deleted_at' => now()]);
        } else {
            // Ambil data yang ada
            $existingKakel = DB::table('d_rps_kakels')
                ->where('rps_id', $rps_id)
                ->get();

            foreach ($kakel_ids as $kakel_id) {
                $existingEntry = $existingKakel->firstWhere('kakel_id', $kakel_id);

                if ($existingEntry) {
                    if ($existingEntry->deleted_at) {
                        // Jika data ada dan deleted_at tidak null, buat data baru
                        DB::table('d_rps_kakels')->insert([
                            'rps_id' => $rps_id,
                            'kakel_id' => $kakel_id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    } else {
                        // Jika data ada dan deleted_at null, update data tersebut
                        DB::table('d_rps_kakels')
                            ->where('rps_id', $rps_id)
                            ->where('kakel_id', $kakel_id)
                            ->update([
                                'deleted_at' => null,
                                'updated_at' => now()
                            ]);
                    }
                } else {
                    // Jika data tidak ada, buat data baru
                    DB::table('d_rps_kakels')->insert([
                        'rps_id' => $rps_id,
                        'kakel_id' => $kakel_id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollback();
        return false;
    }
}



    // public static function spKakel2($rps_id, array $kakel_ids)
    // {
    //     DB::beginTransaction();

    //     try {
    //         foreach ($kakel_ids as $kakel_id) {
    //             DB::table('d_rps_kakels')->updateOrInsert(
    //                 ['rps_id' => $rps_id, 'kakel_id' => $kakel_id],
    //                 ['deleted_at' => null, 'updated_at' => now()]
    //             );
    //         }

    //         DB::commit();
    //         return true;
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return false;
    //     }
    // }

    public static function deleteKakel($rps_id, array $kakel_ids)
    {
        DB::table('d_rps_kakels')
            ->where('rps_id', $rps_id)
            ->whereIn('kakel_id', $kakel_ids)
            ->update(['deleted_at' => now()]);
    }

// Mendapatkan dosen yang is_kakelnya bernilai 1
public static function getIsKakel3()
{
    return DB::table('d_dosen')
        ->select('d_dosen.dosen_id', 'd_dosen.nama_dosen')
        ->leftJoin('s_user', 'd_dosen.user_id', '=', 's_user.user_id')
        ->where('s_user.group_id', 5)
        ->get();
}

public static function getSelectedKakel3($rps_id)
{
    return DB::table('d_rps_kakel')
        ->select('dosen_id as dosen_kakel_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
        ->where('rps_id', $rps_id)
        ->groupBy('dosen_id')
        ->get();
}

public static function spKakel3($rps_id, array $dosen_kakel_ids = null)
{
    DB::beginTransaction();

    try {
        // Jika array $dosen_kakel_ids kosong, hapus semua data yang ada
        if (empty($dosen_kakel_ids)) {
            DB::table('d_rps_kakel')
                ->where('rps_id', $rps_id)
                ->update(['deleted_at' => now()]);
        } else {
            // Ambil data yang ada
            $existingKakel = DB::table('d_rps_kakel')
                ->where('rps_id', $rps_id)
                ->get();

            foreach ($dosen_kakel_ids as $dosen_kakel_id) {
                $existingEntry = $existingKakel->firstWhere('dosen_id', $dosen_kakel_id);

                if ($existingEntry) {
                    if (!is_null($existingEntry->deleted_at)) {
                        // Jika data ada dan deleted_at tidak null, buat data baru
                        DB::table('d_rps_kakel')->insert([
                            'rps_id' => $rps_id,
                            'dosen_id' => $dosen_kakel_id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    } else {
                        // Jika data ada dan deleted_at null, tidak perlu menambah data baru
                        // Update data yang ada untuk memastikan deleted_at tetap null
                        DB::table('d_rps_kakel')
                            ->where('rps_id', $rps_id)
                            ->where('dosen_id', $dosen_kakel_id)
                            ->update([
                                'deleted_at' => null,
                                'updated_at' => now()
                            ]);
                    }
                } else {
                    // Jika data tidak ada, buat data baru
                    DB::table('d_rps_kakel')->insert([
                        'rps_id' => $rps_id,
                        'dosen_id' => $dosen_kakel_id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                }
            }

            // Update deleted_at untuk dosen yang tidak ada dalam daftar baru
            DB::table('d_rps_kakel')
                ->where('rps_id', $rps_id)
                ->whereNotIn('dosen_id', $dosen_kakel_ids)
                ->update(['deleted_at' => now()]);
        }

        DB::commit();
        return true;
    } catch (\Exception $e) {
        DB::rollback();
        return false;
    }
}




public static function deleteKakel3($rps_id, array $dosen_ids)
{
    if (!empty($dosen_ids)) {
        DB::table('d_rps_kakel')
            ->where('rps_id', $rps_id)
            ->whereIn('dosen_id', $dosen_ids)
            ->update(['deleted_at' => now()]);
    }
}
}
