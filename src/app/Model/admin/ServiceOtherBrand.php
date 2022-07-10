<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ServiceOtherBrand extends Model
{
    public $timestamps = false;
	protected $table = 'other_service_brands';
	protected $primaryKey = 'id';
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

    public static function get_other_service_firm_id($service_id){
        $firm = DB::table('firms')
                 ->select('firms.id as firm_id','firms.cgst','firms.sgst','firms.gst_status','firms.gst_discount')
                 ->where('services','["'.$service_id.'"]')
                 ->first();
        return $firm;
  }

}

?>

