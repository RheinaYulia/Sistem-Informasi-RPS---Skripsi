<?php

namespace App\Models\Master;

use App\Models\AppModel;
use App\Models\Dosen\DosenModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class MediaModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_media';
    protected $primaryKey = 'media_id';

    protected static $_table = 'd_media';
    protected static $_primaryKey = 'media_id';

    protected $fillable = [
        'jenis_media',
        'nama_media',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public static function destroyMedia($id)
    {
        $media = self::find($id);

        if ($media) {
            return $media->delete();
        }

        return false;
    }
}