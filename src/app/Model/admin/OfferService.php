<?php

namespace App\Model\admin;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class OfferService extends Model
{
    public $timestamps = false; 
    protected $table = 'offer_services';
	protected $primaryKey = 'id';
    protected $fillable = [
        'offer_id', 'brand_id', 'service_id', 'quantity','price','cgst','sgst','total_price','created'
    ];

    public function services(){
        return $this->belongsTo(Offer::class,'offer_id','id');
    }

    

}
