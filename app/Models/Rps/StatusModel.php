<?php

namespace App\Models\Rps;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class StatusModel extends AppModel
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

    public static function getStatusSah(){
        $map = DB::table('m_rps AS m')
            ->selectRaw('m.rps_id, m.deskripsi_rps,m.kurikulum_mk_id, m.kaprodi_id, k.mk_nama,m.pengesahan')
            ->join('d_kurikulum_mk AS p', function ($join) {
                $join->on('m.kurikulum_mk_id', '=', 'p.kurikulum_mk_id');
            })
            ->join('m_mk AS k', function ($join) {
                $join->on('p.mk_id', '=', 'k.mk_id');
            })
            ->whereIn('m.verifikasi', [2])
            ->whereIn('m.pengesahan', [0, 1,2])
            ->get();
        
        return $map;
    }
    public static function getStatusVer1(){
        $map = DB::table('m_rps AS m')
            ->selectRaw('m.rps_id, m.deskripsi_rps,m.kurikulum_mk_id, m.kaprodi_id, k.mk_nama,m.verifikasi, m.pengesahan')
            ->join('d_kurikulum_mk AS p', function ($join) {
                $join->on('m.kurikulum_mk_id', '=', 'p.kurikulum_mk_id');
            })
            ->join('m_mk AS k', function ($join) {
                $join->on('p.mk_id', '=', 'k.mk_id');
            })
            ->whereIn('m.verifikasi', [0, 1, 2, 3])
            ->whereIn('m.pengesahan', [0, 1,2])
            ->get();
        
        return $map;
    }

    public static function getKetVer($rps_id){
        $map = DB::table('m_rps AS m')
            ->selectRaw('m.rps_id, m.deskripsi_rps,m.kurikulum_mk_id, m.kaprodi_id, k.mk_nama,m.verifikasi, m.pengesahan, m.keterangan_ditolak')
            ->join('d_kurikulum_mk AS p', function ($join) {
                $join->on('m.kurikulum_mk_id', '=', 'p.kurikulum_mk_id');
            })
            ->join('m_mk AS k', function ($join) {
                $join->on('p.mk_id', '=', 'k.mk_id');
            })
            ->where('m.rps_id', $rps_id)
            ->get();
        
        return $map;
    }

    public static function getStatusVer($userId){
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
        ->whereIn('m.verifikasi', [0, 1, 2, 3])
        ->whereIn('m.pengesahan', [0, 1, 2])
        ->whereNull('m.deleted_at')
        ->groupBy('m.rps_id')
        ->get();
    
    return $map;
    }

    public static function getMkRpsSah(){
        $map = DB::table('m_rps AS m')
            ->selectRaw('m.rps_id, m.deskripsi_rps,m.kurikulum_mk_id, m.kaprodi_id, k.mk_nama, m.pengesahan')
            ->join('d_kurikulum_mk AS p', function ($join) {
                $join->on('m.kurikulum_mk_id', '=', 'p.kurikulum_mk_id');
            })
            ->join('m_mk AS k', function ($join) {
                $join->on('p.mk_id', '=', 'k.mk_id');
            })
            ->whereIn('m.verifikasi', [2])
            ->whereIn('m.pengesahan', [0, 1,2])
            ->get();
        
        return $map;
    }
}