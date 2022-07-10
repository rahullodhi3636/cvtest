<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    protected $table = 'roles_permission';
	protected $primaryKey = 'roles_permission_id';
    protected $fillable = [
        'role_id','module_id','can_view','can_add','status','can_edit','can_delete'
    ];
}
