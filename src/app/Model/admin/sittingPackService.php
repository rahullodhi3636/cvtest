<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
class sittingPackService extends Model
{
    public $timestamps = false; 
    protected $table = 'sittingpack_service';
	protected $primaryKey = 'id';
    protected $fillable = [
        'sittingpack_id',
        'sitting_round',
        'brand_id',
        'service_id',
        'quantity',
        'price',
        'cgst',
        'sgst',
        'total_price'
    ];
}
