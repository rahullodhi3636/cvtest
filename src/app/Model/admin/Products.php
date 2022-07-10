<?php  
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Products extends Model
{
	// protected $table = 'users';
	protected $primaryKey = 'id';
    protected $fillable = [
        'firm_id',
        'product_name',
        'product_price',
        'special_price',
        'product_quantity',
        'status',
    ];
}
?>