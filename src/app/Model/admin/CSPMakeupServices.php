<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class CSPMakeupServices extends Model
{
    public $timestamps = false; 
    protected $table = 'CSP_makeupServices';
	protected $primaryKey = 'pack_makeupservice_id';
    protected $fillable = [
        'CSP_id', 'sittingpack_id', 'makeup_round','customer_id','invoice_id','brand_id',
        'service_id','total_price','quantity'
    ];
}
