<?php

namespace App\Models\Rps;

use App\Models\AppModel;
use App\Models\KurikulumMKModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

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

    // Relasi dengan media RPS
    public function mediaRPS()
    {
        return $this->hasMany(MediaRpsModel::class, 'rps_id', 'rps_id');
    }

    // Relasi dengan pengampu
    public function pengampu()
    {
        return $this->hasMany(PengampuModel::class, 'rps_id', 'rps_id');
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
    
    
}
