<?php

namespace App\Models\Master;

use App\Models\AppModel;
use App\Models\Dosen\DosenModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class PustakaModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_pustaka';
    protected $primaryKey = 'pustaka_id';

    protected static $_table = 'd_pustaka';
    protected static $_primaryKey = 'pustaka_id';

    protected $fillable = [
        'jenis_pustaka',
        'referensi',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    

}