<?php
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Addtocart extends Model
{
	protected $table = 'add_to_cart';
	protected $primaryKey = 'id';
    protected $fillable = [
        'item_id',
        'item_name',
        'item_price',
        'item_quantity',
        'customer_id',
        'status'
    ];
}  
?>