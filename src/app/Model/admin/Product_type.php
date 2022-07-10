<?php  
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product_type extends Model
{
	protected $table = 'product_type';
	protected $primaryKey = 'id';
    protected $fillable = [
        'firm_id',
        'type_name',
        'created_at',
        'status',
    ];
}
?>