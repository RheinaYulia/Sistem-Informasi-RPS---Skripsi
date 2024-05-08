<?php

namespace App\Models\Rps;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PengampuModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_rps_pengampu';
    protected $primaryKey = 'rps_pengampu_id';

    protected static $_table = 'd_rps_pengampu';
    protected static $_primaryKey = 'rps_pengampu_id';

    protected $fillable = [
        'rps_pengampu_id',
        'rps_id',
        'dosen_id',
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

    public function rps()
    {
        return $this->belongsTo(RpsModel::class, 'rps_id', 'rps_id');
    }

    public static function getDosenPengampu($rps_id){
        $map = DB::table('d_rps_pengampu AS m')
        ->selectRaw('m.rps_pengampu_id,m.rps_id,m.dosen_id,d.nama_dosen ')
        ->Join('m_rps AS gm', function ($join) use($rps_id){
            $join->on('gm.rps_id', '=', 'm.rps_id')
                ->where('gm.rps_id', '=', $rps_id);
        })
        ->Join('d_dosen AS d', function ($join) {
            $join->on('d.dosen_id', '=', 'm.dosen_id');
        })->get();

        return $map;
    }

    public static function setDosenPengampu($rps_id, $dosen_id){
        // Periksa apakah entri sudah ada dalam database
        $existingEntry = DB::table('d_rps_pengampu')
            ->where('rps_id', $rps_id)
            ->where('dosen_id', $dosen_id)
            ->first();
    
        // Jika entri sudah ada, perbarui
        if($existingEntry){
            DB::table('d_rps_pengampu')
                ->where('rps_id', $rps_id)
                ->where('dosen_id', $dosen_id)
                ->update([
                    'rps_id' => $rps_id,
                    'dosen_id' => $dosen_id,
                    // Tambahkan kolom dan nilai yang ingin Anda perbarui
                ]);
        } else { // Jika entri tidak ada, tambahkan
            DB::table('d_rps_pengampu')->insert([
                'rps_id' => $rps_id,
                'dosen_id' => $dosen_id,
                // Tambahkan kolom dan nilai yang ingin Anda tambahkan
            ]);
        }
    }

}
