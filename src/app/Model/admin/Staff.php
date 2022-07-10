<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Staff extends Model
{   
    protected $table = 'users';
	protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'branch_id',
        'email',
        'name',
        'password',
        'admin',
        'phone_no',
        'image',
        'register_by',
        'status','department'
    ];
}
