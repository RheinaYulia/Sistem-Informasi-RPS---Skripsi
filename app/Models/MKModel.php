<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MKModel extends Model
{
    use SoftDeletes;

    protected $table = 'm_mk';
    protected $primaryKey = 'mk_id';

    protected static $_table = 'm_mk';
    protected static $_primaryKey = 'mk_id';

    protected $fillable = [
        'mk_id',
        'mk_nama',
        'mk_jenis',
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

