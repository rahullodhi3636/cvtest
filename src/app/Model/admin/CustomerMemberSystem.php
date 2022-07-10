<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerMemberSystem extends Model
{
    public $timestamps = false;
    protected $table = 'customer_member_system';
	protected $primaryKey = 'id';
    protected $fillable = [
        'member_sys_id','customer_id','member_name',
        'member_mobile','expire_date','member_otp',
        'status',
    ];
}
