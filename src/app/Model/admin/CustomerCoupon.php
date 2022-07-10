<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CustomerCoupon extends Model
{
    public $timestamps = false; 
    protected $table = 'customer_coupon';
	protected $primaryKey = 'id';
    protected $fillable = [
        'coupon_id', 'customer_id', 'start_date', 'expire_date','status','coupon_code','coupon_used_count'
    ];
}
