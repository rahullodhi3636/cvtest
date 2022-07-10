<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Collection extends Model
{   
    protected $table = 'transaction';
	protected $primaryKey = 'transaction_id';
    protected $fillable = [
        'customer_id',
        'package_id',
        'payment_mode',
        'transaction_amount',
        'transaction_date',
        'status'
    ];
}
