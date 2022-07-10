<?php  
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoiceProductModel extends Model
{
	protected $table = 'invoice_product';
	protected $primaryKey = 'invoice_product_id';
    protected $fillable = [
        'invoice_id',
        'product_id',
        'staff_id',
        'quantity',
        'price',
        'discount',
        'cgst',
        'sgst',
        'total_price',
        'product_status'
    ];
}
?>