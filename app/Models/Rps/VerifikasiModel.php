<?php

namespace App\Models\Rps;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class VerifikasiModel extends AppModel
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
        'verifikasi',
        'pengesahan',
        'keterangan_ditolak',
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

    public static function getMkRpsVer(){
        $map = DB::table('m_rps AS m')
            ->selectRaw('m.rps_id, m.deskripsi_rps,m.kurikulum_mk_id, m.kaprodi_id, k.mk_nama,m.verifikasi,m.pengesahan')
            ->join('d_kurikulum_mk AS p', function ($join) {
                $join->on('m.kurikulum_mk_id', '=', 'p.kurikulum_mk_id');
            })
            ->join('m_mk AS k', function ($join) {
                $join->on('p.mk_id', '=', 'k.mk_id');
            })
            ->whereIn('m.verifikasi', [1, 2,3])
            ->get();
        
        return $map;
    }

    public static function getmkver($userId) {
        $periode = session('periode');
    
        if (!$periode || !isset($periode->periode_id)) {
            // Handle the case where periode is not set in session
            return collect();
        }
    
        $selectedPeriodeId = $periode->periode_id;
    
        $map = DB::table('m_rps AS m')
            ->selectRaw('m.rps_id, m.deskripsi_rps, m.kurikulum_mk_id, m.kaprodi_id, k.mk_nama, ds.nama_dosen, m.verifikasi, m.pengesahan')
            ->join('d_kurikulum_mk AS p', function($join) use ($selectedPeriodeId) {
                $join->on('m.kurikulum_mk_id', '=', 'p.kurikulum_mk_id')
                     ->where('p.periode_id', '=', $selectedPeriodeId);
            })
            ->join('m_mk AS k', 'p.mk_id', '=', 'k.mk_id')
            ->join('d_kaprodi AS d', 'm.kaprodi_id', '=', 'd.kaprodi_id')
            ->join('d_dosen AS ds', 'd.dosen_id', '=', 'ds.dosen_id')
            ->leftJoin('d_rps_kakel AS rk', 'm.rps_id', '=', 'rk.rps_id')
            ->leftJoin('t_kakel_mk AS tk', 'rk.kakel_mk_id', '=', 'tk.kakel_mk_id')
            ->leftJoin('d_kakel AS dk', 'tk.d_kakel_id', '=', 'dk.d_kakel_id')
            ->leftJoin('d_dosen AS dp_kakel', 'dk.dosen_id', '=', 'dp_kakel.dosen_id')
            ->leftJoin('s_user AS su_kakel', 'dp_kakel.user_id', '=', 'su_kakel.user_id')
            ->where(function ($query) use ($userId) {
                $query->where('su_kakel.user_id', $userId)
                      ->whereNull('dk.deleted_at')
                      ->orWhere('m.created_by', $userId)
                      ->orWhereRaw('? = 1', [$userId]);
            })
            ->whereIn('m.verifikasi', [ 1, 2, 3])
            ->whereIn('m.pengesahan', [0, 1, 2])
            ->whereNull('m.deleted_at')
            ->groupBy('m.rps_id')
            ->get();
    
        return $map;
    }
    
    
    
    

    public static function getmkver2($userId) {
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
            ->leftJoin('d_rps_kakels AS rk', function ($join) {
                $join->on('m.rps_id', '=', 'rk.rps_id');
            })
            ->leftJoin('d_kakel AS d_kakel', function ($join) {
                $join->on('rk.kakel_id', '=', 'd_kakel.kakel_id');
            })
            ->leftJoin('d_dosen AS dp_kakel', function ($join) {
                $join->on('d_kakel.dosen_id', '=', 'dp_kakel.dosen_id');
            })
            ->leftJoin('s_user AS su_kakel', 'dp_kakel.user_id', '=', 'su_kakel.user_id')
            ->join('d_kurikulum AS dk', 'p.kurikulum_id', '=', 'dk.kurikulum_id') // Join dengan tabel d_kurikulum
            ->join('m_periode AS pr', 'dk.periode_id', '=', 'pr.periode_id') // Join dengan tabel m_periode
            ->where('pr.periode_id', $selectedPeriodeId) // Filter berdasarkan periode yang dipilih
            ->where(function ($query) use ($userId) {
                $query->where('su_kakel.user_id', $userId)
                    ->whereNull('rk.deleted_at')
                    ->orWhere('m.created_by', $userId)
                    ->orWhereRaw('? = 1', [$userId]);
            })
            ->whereIn('m.verifikasi', [1, 2, 3])
            ->whereIn('m.pengesahan', [0, 1, 2])
            ->whereNull('m.deleted_at')
            ->groupBy('m.rps_id')
            ->get();
        
        return $map;
    }
    
}