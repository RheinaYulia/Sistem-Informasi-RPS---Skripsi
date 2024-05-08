<?php

namespace App\Models\Rps;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class MediaRpsModel extends Model
{
    use SoftDeletes;

    protected $table = 'd_rps_media';
    protected $primaryKey = 'rps_media_id';

    protected static $_table = 'd_rps_media';
    protected static $_primaryKey = 'rps_media_id';

    protected $fillable = [
        'rps_media_id',
        'rps_id',
        'jenis_media',
        'nama_media',
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

    public static function getMediaRps($rps_id){
        $map = DB::table('d_rps_media AS m')
        ->selectRaw('m.rps_media_id,m.jenis_media,m.nama_media ')
        ->Join('m_rps AS gm', function ($join) use($rps_id){
            $join->on('gm.rps_id', '=', 'm.rps_id')
                ->where('gm.rps_id', '=', $rps_id);
        })->get();

        return $map;
    }
}
