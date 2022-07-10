<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CouponService extends Model
{
    public $timestamps = false; 
    protected $table = 'coupon_service';
	protected $primaryKey = 'id';
    protected $fillable = [
        'coupon_id', 'brand_id', 'service_id', 'quantity','price','cgst','sgst','total_price'
    ];
}
