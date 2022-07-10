<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Services extends Model
{   
	protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'group_id',
        'description',
        'admin_id',
        'staff',
        'status',
        'service_icon',
        'service_price',
        'duration',
        'special_price'
    ];

   


}
