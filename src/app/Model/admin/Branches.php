<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Branches extends Model
{   
	protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'address',
        'phone',
        'admin_id',
        'status'
    ];
}
