<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MemberSystemService extends Model
{
    public $timestamps = false; 
    protected $table = 'membersystem_service';
	protected $primaryKey = 'id';
    protected $fillable = [
        'member_sys_id','brand_id','service_id',
        'price','cgst','sgst',
        'total_price','free_count',
        'per_month_count',
        'valid_after_days',
        'created',
    ];
}
