<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CustomersittingPackMakeupPayment extends Model
{
    public $timestamps = false; 
    protected $table = 'customer_sittingpack_makeup_payment';
	protected $primaryKey = 'id';
    protected $fillable = [
        'sittingpack_id','customer_id','invoice_id','makeup_round','CSP_id',
        'makeupPayment','makeupStatus','makeupDate','makeupTime'
    ];
}
