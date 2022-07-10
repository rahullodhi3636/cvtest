<?php  
namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Membership extends Model
{
	
	protected $table = 'membership';
	protected $primaryKey = 'id';
    protected $fillable = [
        'firm_id',
        'membership_title',
        'membership_price',
        'service_discount_type',
        'service_discount',
        'product_discount_type',
        'product_discount',
        'membership_validity',
        'tax_applicable',
        'status',
    ];
}
?>