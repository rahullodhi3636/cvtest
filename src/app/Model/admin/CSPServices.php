<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CSPServices extends Model
{
    public $timestamps = false; 
    protected $table = 'CSP_Services';
	protected $primaryKey = 'pack_service_id';
    protected $fillable = [
        'CSP_id', 'sittingpack_id', 'sitpack_round','customer_id','invoice_id','brand_id',
        'service_id','total_price','quantity'
    ];
}
