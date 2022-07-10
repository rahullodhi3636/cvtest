<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false; 
    protected $table = 'roles';
	protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_name',
        'status',
    ];
}
