<?php

namespace App\Models\Dosen;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DosenModel extends AppModel
{
    use SoftDeletes;

    protected $table = 'd_dosen';
    protected $primaryKey = 'dosen_id';
    protected $uniqueKey = 'nama_dosen';

    protected static $_table = 'd_dosen';
    protected static $_primaryKey = 'dosen_id';
    protected static $_uniqueKey = 'nama_dosen';

    protected $fillable = [
        'dosen_id',
        'nama_dosen',
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
