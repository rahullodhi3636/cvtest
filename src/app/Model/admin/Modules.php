<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modules extends Model
{
    protected $table = 'modules';
	protected $primaryKey = 'module_id';
    protected $fillable = [
        'module_name','module_icon','module_url','module_order','is_active'
    ];
}
