<?php

namespace App\Models;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class KurikulumMKModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_kurikulum_mk';
    protected $primaryKey = 'kurikulum_mk_id';

    protected static $_table = 'd_kurikulum_mk';
    protected static $_primaryKey = 'kurikulum_mk_id';

    protected $fillable = [
        'kurikulum_mk_id',
        'kurikulum_id',
        'rumpun_mk_id',
        'mk_id',
        'prodi_id',
        'kode_mk',
        'sks',
        'semester',
        'jumlah_jam',
        'kelompok_mk',
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

    
    public static function getMks(){
        $map = DB::table('d_kurikulum_mk AS m')
            ->selectRaw('m.kurikulum_mk_id, k.mk_nama')
            ->join('m_mk AS k', function ($join) {
                $join->on('m.mk_id', '=', 'k.mk_id');
            })
            ->get();
        
        return $map;
    }
}

