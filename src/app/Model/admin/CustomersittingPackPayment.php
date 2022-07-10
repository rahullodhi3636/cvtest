<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CustomersittingPackPayment extends Model
{
    public $timestamps = false; 
    protected $table = 'customer_sittingpack_payment';
	protected $primaryKey = 'id';
    protected $fillable = [
        'sittingpack_id','customer_id','invoice_id','sitting_round','CSP_id',
        'sittingPayment','sittingStatus'
    ];
}
