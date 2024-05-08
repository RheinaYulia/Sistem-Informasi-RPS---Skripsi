<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KaprodiModel extends Model
{
    use SoftDeletes;

    protected $table = 'd_kaprodi';
    protected $primaryKey = 'kaprodi_id';

    protected static $_table = 'd_kaprodi';
    protected static $_primaryKey = 'kaprodi_id';

    protected $fillable = [
        'kaprodi_id',
        'prodi_id',
        'tahun',
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

