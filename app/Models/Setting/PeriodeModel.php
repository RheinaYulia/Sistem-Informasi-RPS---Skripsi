<?php

namespace App\Models\Setting;

use App\Models\AppModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PeriodeModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'm_periode';
    protected $primaryKey = 'periode_id';
    protected $uniqueKey = 'periode_name';

    protected static $_table = 'm_periode';
    protected static $_primaryKey = 'periode_id';
    protected static $_uniqueKey = 'periode_name';

    protected $fillable = [
        'periode_name',
        'is_active',
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
}
