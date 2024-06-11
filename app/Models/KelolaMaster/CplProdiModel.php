<?php

namespace App\Models\KelolaMaster;

use App\Models\AppModel;
use App\Models\Dosen\DosenModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CplProdiModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_rps_cpl_prodi';
    protected $primaryKey = 'rps_cpl_prodi_id';

    protected static $_table = 'd_rps_cpl_prodi';
    protected static $_primaryKey = 'rps_cpl_prodi_id';

    protected $fillable = [
        'rps_id',
        'cp_prodi_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

}