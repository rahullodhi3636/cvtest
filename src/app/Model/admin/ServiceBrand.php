<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceBrand extends Model
{
	protected $table = 'service_brands';
	protected $primaryKey = 'service_brand_id';
    protected $fillable = [
        'service_id',
        'sub_cate_id',
        'brand_id',
        'brand_name',
        'service_price',
        'special_price',
        'service_description',
        'service_duration',
        'service_brand_status',
    ];

    public static function getservicebrand($brand_id){
          $brand = DB::table('service_brands')
                   ->select('service_brands.*','firms.id as firm_id','firms.cgst','firms.sgst','firms.gst_status','firms.gst_discount','firms.composition','firms.composition_status')
                   ->leftJoin('service_group','service_brands.sub_cate_id','service_group.id')
                   ->leftJoin('firms','firms.id','service_group.firm_id')
                   ->where('service_brand_id',$brand_id)
                   ->first();
          return $brand;
    }
}

?>
