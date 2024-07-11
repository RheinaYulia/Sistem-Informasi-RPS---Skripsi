<?php

namespace App\Models\Kakel;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class KakelModel extends AppModel
{
    protected $table = 'm_kakel';

    public static function getListKakel()
{
    $periode = session('periode');
    
    if (!$periode || !isset($periode->periode_id)) {
        return collect(); // Mengembalikan koleksi kosong jika periode tidak ada
    }

    $selectedPeriodeId = $periode->periode_id;

    return DB::table('m_kakel')
        ->select('m_kakel.m_kakel_id', 'm_kakel.jabatan', 'd_dosen.nama_dosen')
        ->leftJoin('d_kakel', function($join) use ($selectedPeriodeId) {
            $join->on('m_kakel.m_kakel_id', '=', 'd_kakel.m_kakel_id')
                 ->where('d_kakel.periode_id', '=', $selectedPeriodeId);
        })
        ->leftJoin('d_dosen', 'd_dosen.dosen_id', '=', 'd_kakel.dosen_id')
        ->get();
}


    public static function getEditKakel($m_kakel_id)
    {
        $periode = session('periode');
        if (!$periode || !isset($periode->periode_id)) {
            return null;
        }

        $selectedPeriodeId = $periode->periode_id;

        return DB::table('m_kakel')
            ->select('m_kakel.m_kakel_id', 'm_kakel.jabatan', 'd_dosen.dosen_id', 'd_dosen.nama_dosen', 'd_kakel.d_kakel_id', 'm_mk.mk_nama', 'd_kurikulum_mk.kurikulum_mk_id', 't_kakel_mk.deleted_at')
            ->leftJoin('d_kakel', function($join) use ($selectedPeriodeId) {
                $join->on('m_kakel.m_kakel_id', '=', 'd_kakel.m_kakel_id')
                     ->where('d_kakel.periode_id', '=', $selectedPeriodeId);
            })
            ->leftJoin('d_dosen', 'd_dosen.dosen_id', '=', 'd_kakel.dosen_id')
            ->leftJoin('t_kakel_mk', 'd_kakel.d_kakel_id', '=', 't_kakel_mk.d_kakel_id')
            ->leftJoin('d_kurikulum_mk', 't_kakel_mk.kurikulum_mk_id', '=', 'd_kurikulum_mk.kurikulum_mk_id')
            ->leftJoin('d_kurikulum', 'd_kurikulum_mk.kurikulum_id', '=', 'd_kurikulum.kurikulum_id')
            ->leftJoin('m_mk', 'd_kurikulum_mk.mk_id', '=', 'm_mk.mk_id')
            ->where('m_kakel.m_kakel_id', $m_kakel_id)
            ->where('d_kurikulum_mk.periode_id', $selectedPeriodeId)
            ->first();
    }

    public static function getAllMataKuliah()
    {
        $periode = session('periode');

        if (!$periode || !isset($periode->periode_id)) {
            return DB::table('d_kurikulum_mk')
                ->leftJoin('m_mk', 'd_kurikulum_mk.mk_id', '=', 'm_mk.mk_id')
                ->select('d_kurikulum_mk.kurikulum_mk_id', 'm_mk.mk_nama')
                ->get();
        }    

        $selectedPeriodeId = $periode->periode_id;

        return DB::table('d_kurikulum_mk')
            ->leftJoin('m_mk', 'd_kurikulum_mk.mk_id', '=', 'm_mk.mk_id')
            ->leftJoin('d_kurikulum', 'd_kurikulum_mk.kurikulum_id', '=', 'd_kurikulum.kurikulum_id')
            ->leftJoin('m_periode', 'd_kurikulum_mk.periode_id', '=', 'm_periode.periode_id')
            ->select('d_kurikulum_mk.kurikulum_mk_id', 'm_mk.mk_nama')
            ->where('m_periode.periode_id', $selectedPeriodeId)
            ->get();
    }

    public static function getAllDosen()
    {
        return DB::table('d_dosen')
            ->select('dosen_id', 'nama_dosen')
            ->get();
    }

    public static function updateDataKakel($id, $request)
    {
        $periode = session('periode');

        if (!$periode || !isset($periode->periode_id)) {
            return false;
        }

        $periodeId = $periode->periode_id;

        DB::beginTransaction();
        try {
            // Update dosen_id di tabel d_kakel
            DB::table('d_kakel')
                ->updateOrInsert(
                    ['m_kakel_id' => $id],
                    [
                        'dosen_id' => $request->dosen_id,
                        'periode_id' => $periodeId
                    ]
                );

            // Ambil data existing di t_kakel_mk berdasarkan m_kakel_id
            $existingKakelMK = DB::table('t_kakel_mk')
                ->where('d_kakel_id', $id)
                ->get();
            $existingKakelMKIds = $existingKakelMK->pluck('kurikulum_mk_id')->toArray();

            // Handle insert/update data kurikulum_mk_id jika ada dalam request
            if ($request->has('kurikulum_mk_id')) {
                foreach ($request->kurikulum_mk_id as $kurikulum_mk_id) {
                    if (in_array($kurikulum_mk_id, $existingKakelMKIds)) {
                        // Update existing data
                        DB::table('t_kakel_mk')
                            ->where('d_kakel_id', $id)
                            ->where('kurikulum_mk_id', $kurikulum_mk_id)
                            ->update(['deleted_at' => null, 'updated_at' => now()]);
                    } else {
                        // Insert new data
                        DB::table('t_kakel_mk')->insert([
                            'd_kakel_id' => $id,
                            'kurikulum_mk_id' => $kurikulum_mk_id,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                    }
                }

                // Hapus data yang tidak ada dalam request
                DB::table('t_kakel_mk')
                    ->where('d_kakel_id', $id)
                    ->whereNotIn('kurikulum_mk_id', $request->kurikulum_mk_id)
                    ->update(['deleted_at' => now(), 'deleted_by' => auth()->user()->id]);
            } else {
                // Jika tidak ada kurikulum_mk_id dalam request, hapus semua data existing
                DB::table('t_kakel_mk')
                    ->where('d_kakel_id', $id)
                    ->update(['deleted_at' => now(), 'deleted_by' => auth()->user()->id]);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Update Data Kakel Error: ', ['error' => $e->getMessage()]);
            return false;
        }
    }

    public static function deleteKakelMK($kurikulumMkIds, $kakelId) {
        foreach ($kurikulumMkIds as $kurikulumMkId) {
            DB::table('t_kakel_mk')
                ->where('kurikulum_mk_id', $kurikulumMkId)
                ->where('d_kakel_id', $kakelId)
                ->update([
                    'deleted_at' => now(),
                    'deleted_by' => auth()->user()->id
                ]);
        }
        return true;
    }

    public static function getSelectedKakelMK($m_kakel_id)
    {
        return DB::table('t_kakel_mk')
            ->select('kurikulum_mk_id', DB::raw('MAX(deleted_at IS NULL) as is_selected'))
            ->where('d_kakel_id', $m_kakel_id)
            ->groupBy('kurikulum_mk_id')
            ->get();
    }
}