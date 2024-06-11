<?php

namespace App\Models\Rps;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PengembangModel extends AppModel
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

    public static function getMkRpsDosen(){
        $map = DB::table('d_dosen')
            ->selectRaw('d_dosen.dosen_id, d_dosen.nama_dosen, d_dosen.user_id, d_dosen.is_pengembang')
            ->join('s_user', function ($join) {
                $join->on('d_dosen.user_id', '=', 's_user.user_id');
            })
            ->where('d_dosen.is_pengembang',1)
            ->get();
        
        return $map;
    }

    public static function spUpdatePengembang(array $dosen_ids, array $is_pengembang)
{
    DB::beginTransaction();

    try {
        foreach ($dosen_ids as $dosen_id) {
            $pengembang_value = isset($is_pengembang[$dosen_id]) ? 1 : 0;

            DB::table('d_dosen')
                ->where('dosen_id', $dosen_id)
                ->update([
                    'is_pengembang' => $pengembang_value,
                    'updated_at' => now() // Optional, jika ada kolom updated_at
                ]);
        }

        DB::commit();

        return true; // Jika transaksi berhasil
    } catch (\Exception $e) {
        DB::rollback();
        return false; // Jika terjadi kesalahan
    }
}



    
}