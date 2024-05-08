<?php

namespace App\Models\View;

use App\Models\AppModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RpsView extends AppModel
{
    protected $table = 'vw_rps';
    protected $primaryKey = 'rps_id';

    protected static $_table = 'vw_rps';
    protected static $_primaryKey = 'rps_id';

    protected $fillable = []; // data view tidak dapat di insert, hanya di select

   
}
