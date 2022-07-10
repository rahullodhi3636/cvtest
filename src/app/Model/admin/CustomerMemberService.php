<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerMemberService extends Model
{
    public $timestamps = false;
    protected $table = 'customer_member_service';
	protected $primaryKey = 'id';
    protected $fillable = [
        'member_sys_id','customer_id','member_mobile','service_id','service_free_count','service_per_month_count',
        'service_valid_after_days','service_last_used'
    ];
}
