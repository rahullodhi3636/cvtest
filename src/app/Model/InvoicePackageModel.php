<?php  
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InvoicePackageModel extends Model
{
	protected $table = 'invoice_package';
	protected $primaryKey = 'invoice_package_id';
    protected $fillable = [
        'invoice_id',
        'package_id',
        // 'staff_id',
        // 'quantity',
        'price',
        'discount',
        'cgst',
        'sgst',
        'total_price',
        'package_status'
    ];
}
?>