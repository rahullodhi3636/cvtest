<?php
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Brand extends Model
{
	protected $table = 'product_brands';
	protected $primaryKey = 'id';
    protected $fillable = [
    	'service_id',
    	'sub_category_id',
    	'brand_icon',
        'brand_name',
        'brand_description',
        'status'
    ];
}
?>
