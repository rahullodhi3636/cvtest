<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class ComboService extends Model
{
    public $timestamps = false; 
    protected $table = 'combo_service';
	protected $primaryKey = 'id';
    protected $fillable = [
        'combo_id', 'brand_id', 'service_id', 'quantity','price','cgst','sgst','total_price'
    ];
}
