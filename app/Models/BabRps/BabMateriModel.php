<?php

namespace App\Models\BabRps;

use App\Models\AppModel;
use App\Models\Dosen\DosenModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class BabMateriModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_rps_bab_materi';
    protected $primaryKey = 'rps_bab_materi_id';

    protected static $_table = 'd_rps_bab_materi';
    protected static $_primaryKey = 'rps_bab_materi_id';

    protected $fillable = [
        'bab_id',
        'judul_materi',
        'file_url',
        'file_dir',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

   
}