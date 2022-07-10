<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CustomerWallet extends Model
{
    public $timestamps = false;
    protected $table = 'customer_wallet';
	protected $primaryKey = 'id';
    protected $fillable = [
        'customer_id',
        'invoice_id',
        'amount_allow',
        'amount_used',
        'created_at',
        'customer_wallet'
    ];
}
