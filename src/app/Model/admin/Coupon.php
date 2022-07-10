<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false;
    protected $table = 'coupon';
    protected $primaryKey = 'id';
    protected $fillable = [
        'coupon_title','coupon_type','coupon_discount', 'coupon_total', 'coupon_price','coupon_validity','allow_count','min_amount', 'created','coupon_prefix','start_date','expire_date'
    ];
}
