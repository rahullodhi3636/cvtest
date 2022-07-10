<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Remark extends Model
{   
    protected $table = 'remark';
	protected $primaryKey = 'id';
    protected $fillable = [
        'c_id',
        'remark',
        'status_id',
        'date',
        'updated_date',
        'sid',
        'is_del'
    ];
}
