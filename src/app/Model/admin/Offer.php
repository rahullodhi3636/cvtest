<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

// use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    public $timestamps = false;
    protected $table = 'offers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'offer_title', 'offer_party','offer_price','ofr_code','code_prefix',
        'offer_type', 'description','offer_from','offer_to','membership_id',
        'discount_type', 'discount','created'
    ];

    public function services(){
        return $this->hasMany(OfferService::class,'offer_id','id');
    }




}
