<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceGroup extends Model
{
    protected $table = 'service_group';
	protected $primaryKey = 'id';
    protected $fillable = [
        'firm_id',
        'group_name',
        'parent_id',
        'status',
    ];
}
