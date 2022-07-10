<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CustomerOffer extends Model
{
    public $timestamps = false;
    protected $table = 'customer_offer';
	protected $primaryKey = 'id';
    protected $fillable = [
        'offer_id', 'customer_id', 'start_date', 'expire_date','status','offer_code','offer_used_count','used_by'
    ];
}
